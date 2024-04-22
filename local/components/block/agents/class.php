<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Errorable;
use \Bitrix\Main\Engine\Contract\Controllerable;

use \Bitrix\Main\Error;
use \Bitrix\Main\ErrorCollection;

use \Bitrix\Main\Application;

use \Bitrix\Main\Data\Cache;
use \Bitrix\Main\Data\TaggedCache;

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Highloadblock\HighloadBlockTable;
use \Bitrix\Main\Engine\ActionFilter;

class AgentsList extends CBitrixComponent implements Controllerable, Errorable
{
    protected ErrorCollection $errorCollection;

    protected Cache $cache;
    protected TaggedCache $taggedCache;

    protected int $cacheTime;
    protected bool $cacheInvalid;
    protected string $cacheKey;
    protected string $cachePatch;

    /**
     * Получение ошибок
     */
    final public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    final public function getErrorByCode($code): Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    /**
     * Добавление ошибки
     */
    private function addError(Error $error): void
    {
        $this->errorCollection[] = $error;
    }

    /**
     * Добавление ошибок
     */
    private function addErrors(array $errors): void
    {
        $this->errorCollection->add($errors);
    }

    /**
     * Вывод ошибок в публичке
     */
    private function showErrors(): bool
    {
        if (count($this->getErrors())) {
            foreach ($this->getErrors() as $error) {
                if ((int)$error->getCode() === 404) {
                    ShowError($error->getMessage());
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Обязательный метод, запускается всегда при загрузки класса, используется для проверки Параметров
     */
    final public function onPrepareComponentParams($arParams): array
    {
        // Создание параметров для работы кеша
        $this->initCache($arParams);

        // Проверка подключения модуля highloadblock
        if (!Loader::includeModule('highloadblock')) {
            // Ошибка если модуль не подключен
            $this->addError(
                new Error(Loc::getMessage('MCART_AGENTS_LIST_MODULE_NOT_INSTALLED', ['#MODULE#' => 'highloadblock']), 404)
            );
        }

        // Проверка и установка дефолтного значения для параметра "Время кеширования"
        if (!isset($arParams['CACHE_TIME'])) {
            $arParams['CACHE_TIME'] = 360000;
        }

        // Проверка и установка дефолтного значения для параметра "Количество элементов"
        if (!isset($arParams['PAGE_ELEMENT_COUNT'])) {
            $arParams['PAGE_ELEMENT_COUNT'] = 10; // Дефолтное значение: 10 элементов на странице
        }

        return parent::onPrepareComponentParams($arParams);
    }


    private function initCache($arParams): void
    {
        $this->cacheInvalid = false;
        $this->errorCollection = new ErrorCollection();
        $this->cacheKey = self::class . '_' . md5(json_encode($arParams)) . '_' . md5(json_encode($_REQUEST)); // тут указывается от каких параметров зависит кэш
        $this->cachePatch = self::class; // директория для хранения файлов кеша

        $this->cache = Cache::createInstance();
        $this->taggedCache = Application::getInstance()->getTaggedCache();
    }

    final public function executeComponent(): void
    {
        if (empty($this->arParams["HLBLOCK_TNAME"])) {
            // Если параметр Название таблицы (TABLE_NAME) Highload-блока не задан, создаем ошибку
            $this->addError(
                new Error(Loc::getMessage('MCART_AGENTS_LIST_NOT_HLBLOCK_TNAME'))
            );
            return;
        }

        if ($this->showErrors()) {
            return;
        }

        // Проверка кеша
        if ($this->cache->initCache(
            $this->arParams["CACHE_TIME"],
            $this->cacheKey,
            $this->cachePatch
        )) { // если кеш есть
            $this->arResult =  $this->cache->getVars();
        } elseif ($this->cache->startDataCache()) { // если кеша нет
            $this->taggedCache->startTagCache($this->cachePatch); // старт для области, для тегированного кеша

            $this->arResult = []; // объявим результирующий массив

            $arHlblock = self::getHlblockTableName($this->arParams["HLBLOCK_TNAME"]); // получить хлблок по TABLE_NAME

            $this->taggedCache->registerTag('hlblock_table_name_' . $arHlblock['TABLE_NAME']); // Регистрируем кеш, чтобы по нему на событиях добавление/изменение/удаление элементов хлблока сбрасывать кеш компонента

            $entity = self::getEntityDataClassById($arHlblock); // получить класс для работы с хлблоком
            $arTypeAgents = self::getFieldListValue($arHlblock, 'UF_TYPE'); // получить массив со значениями списочного свойства Виды деятельности агентов
            $this->arResult['AGENTS'] = $this->getAgents($entity, $arTypeAgents); // получить массив со списком агентов и объектом для пагинации

            if ($this->cacheInvalid) {
                $this->taggedCache->abortTagCache();
                $this->cache->abortDataCache();
            }

            $this->taggedCache->endTagCache(); // конец области, для тегированого кеша
            $this->cache->endDataCache($this->arResult); // запись arResult в кеш
        }

        // Получение избранных агентов для текущего пользователя и запись их в массив $this->arResult['STAR_AGENTS']
        $category = 'mcart_agent';
        $name = 'options_agents_star';
        $this->arResult['STAR_AGENTS'] = CUserOptions::GetOption($category, $name);

        $this->IncludeComponentTemplate(); // вызов шаблона компонента
    }



    /**
     * Метод для получения данных хлблока по TABLE_NAME
     * @param string $hl_block_name - название таблицы хлблока
     * @return array
     */
    private static function getHlblockTableName(string $hl_block_name): array
    {
        if (empty($hl_block_name) || strlen($hl_block_name) < 1) {
            return [];
        }

        // Делаем запрос для получения данных хлблока по TABLE_NAME, используя HighloadBlockTable::getList
        $result = HighloadBlockTable::getList([
            'filter' => [
                '=TABLE_NAME' => $hl_block_name, // Указываем фильтр по полю "TABLE_NAME"
            ],
        ]);

        if ($row = $result->fetch()) { // Получим результат запроса
            return $row;
        }

        return [];
    }


    /**
     * Метод для получения класса для работы с элементами хлблока
     * @param array $arHlblock - массив с данными хлблока
     * @return string
     */
    private static function getEntityDataClassById(array $arHlblock): string
    {
        if (empty($arHlblock)) {
            return '';
        }

        // Получаем объект Highload-блока по его ID
        $hlblockId = $arHlblock['ID'];
        $hlblock = HighloadBlockTable::getById($hlblockId)->fetch();

        if (!$hlblock) {
            return '';
        }

        // Получаем класс данных (DataClass) для Highload-блока
        $entity = HighloadBlockTable::compileEntity($hlblock);
        $entityDataClass = $entity->getDataClass();

        return $entityDataClass;
    }


    /**
     * Метод для получения значений списочного свойства
     * @param array $arHlblock - массив с данными хлобка (нужен ID хлобка)
     * @param string $fieldName - Код списочного свойства
     * @return array
     */


    private function getFieldListValue(array $arHlblock, string $fieldName): array
    {
        $result = [];

        // Получаем ID пользовательского поля, по его коду
        $fieldID = Bitrix\Main\UserFieldTable::getList([
            'filter' => [
                "ENTITY_ID" => "HLBLOCK_" . $arHlblock['ID'],
                "FIELD_NAME" => $fieldName,
            ],
        ])->fetch()["ID"];

        if ($fieldID) {
            // Получаем список свойств для $fieldID, используя класс CUserFieldEnum
            $rsEnum = CUserFieldEnum::GetList([], [
                'USER_FIELD_ID' => $fieldID,
            ]);
            while ($arEnum = $rsEnum->GetNext()) {
                $result[] = [
                    'ID' => $arEnum['ID'],
                    'VALUE' => $arEnum['VALUE'],
                    'XML_ID' => $arEnum['XML_ID'],
                ];
            }
        }

        return $result;
    }



    /**
     * Метод для получения списка агентов
     * @param string $entity - класс хлблока
     * @param array $arTypeAgents - массив Видов деятельности агентов
     * @return array|array[]
     */
    private function getAgents(string $entity, array $arTypeAgents): array
    {
        $arAgents = [
            'NAV_OBJECT' => [], // для построения постраничной навигации
            'ITEMS' => [], // список агентов
        ];

        // Получаем параметр "Количество элементов" из массива $this->arParams
        $pageSize = isset($this->arParams['PAGE_ELEMENT_COUNT']) ? (int)$this->arParams['PAGE_ELEMENT_COUNT'] : 10;

        // Объект для постраничной навигации
        $nav = new \Bitrix\Main\UI\PageNavigation("nav-agents");
        $nav->allowAllRecords(true)
            ->setPageSize($pageSize) // Устанавливаем количество элементов на странице
            ->initFromUri();

        // Запрос для получения списка "Активных" агентов с использованием пагинации
        $rsAgents = $entity::GetList([
            'select' => ['*'],
            'filter' => [
                // Условия фильтрации, например, "Активные" агенты
                'UF_ACTIVITY' => '1',
            ],
            'order' => [], // Порядок сортировки, если требуется
            'count_total' => true, // Учитывать общее количество элементов для постраничной навигации
            'offset' => $nav->getOffset(), // Смещение для текущей страницы
            'limit' => $nav->getLimit(), // Количество элементов на странице
        ]);

        // Устанавливаем объект для постраничной навигации
        // Формируем список агентов
        while ($arAgent = $rsAgents->fetch()) {
            /**
             * Обработка полученного массива
             *
             * 1. Получение значения поля "Вид деятельности" по его ID из массива $arTypeAgents
             */
            if (!empty($arTypeAgents[$arAgent['UF_TYPE']])) {
                $arAgent['ACTIVITY_TYPE'] = $arTypeAgents[$arAgent['UF_TYPE']]['VALUE'];
            } else {
                $arAgent['ACTIVITY_TYPE'] = ''; // Значение по умолчанию, если тип деятельности не найден
            }

            /**
             * 2. Получение пути к файлу для поля "Фото", если ID файла существует
             */
            if (!empty($arAgent['UF_PHOTO'])) {
                $arAgent['PHOTO_PATH'] = \CFile::GetPath($arAgent['UF_PHOTO']);
            } else {
                $arAgent['PHOTO_PATH'] = ''; // Значение по умолчанию, если фото не найдено
            }

            // Записываем агента в массив
            $arAgents['ITEMS'][$arAgent['ID']] = $arAgent;
        }


        $nav->setRecordCount($rsAgents->getCount()); // В объект для пагинации передаем общее количество агентов
        $arAgents['NAV_OBJECT'] = $nav; // Записываем получившийся объект в $arAgents['NAV_OBJECT']

        return $arAgents; // Возвращаем результат
    }




    // Далее код для ajax, к нему можно вернуться после внедрения верски и js
    /**
     * Конфигурация событий для ajax
     */
    final public function configureActions(): array
    {
        return [
            'clickStar' => [
                'prefilters' => [
                    new ActionFilter\Authentication(),
                    new ActionFilter\HttpMethod(
                        [ActionFilter\HttpMethod::METHOD_POST]
                    ),
                    new ActionFilter\Csrf(),
                ]
            ],
        ];
    }

    /**
     * Метод для изменения избранных агентов через ajax
     * @param $agentID - ID элемента агента
     * @return array|string[]
     */
    public function clickStarAction($agentID)
    {
        $result = []; // ответ, который уйдет на фронт

        // Получаем текущего пользователя
        global $USER;

        // Получаем текущий массив избранных агентов для пользователя
        $value = CUserOptions::GetOption('mcart_agent', 'options_agents_star', [], $USER->GetID());

        // Проверяем, является ли значение массивом
        if (!is_array($value)) {
            $value = [];
        }

        // Проверяем, существует ли уже $agentID в массиве избранных агентов
        $key = array_search($agentID, $value);
        if ($key !== false) {
            // Если $agentID уже есть в массиве, удаляем его
            unset($value[$key]);
            $result['isStarred'] = false; // Сохраняем информацию, что агент больше не избранный
        } else {
            // Иначе, добавляем $agentID в массив
            $value[] = $agentID;
            $result['isStarred'] = true; // Сохраняем информацию, что агент теперь избранный
        }

        // Записываем обновленный массив в настройки пользователя
        CUserOptions::SetOption('mcart_agent', 'options_agents_star', $value, false, $USER->GetID());

        // Регистрация кеш-тега для сброса кеша компонента при изменении списка избранных агентов
        
        // Устанавливаем ключ 'action' со значением 'success' в массиве $result
        $result['action'] = 'success';

        return $result;
    }



}
