<?php

// Файл CacheDel.php

namespace MyNamespace; // Замените на ваше пространство имён

use Bitrix\Main\EventManager;

class CacheDel
{
    protected $agentsList;

    // Конструктор для передачи экземпляра AgentsList
    public function __construct(AgentsList $agentsList)
    {
        $this->agentsList = $agentsList;
    }

    // Функция для подписки на события добавления, обновления и удаления элементов хайлоадблока
    public function subscribeToEvents(): void
    {
        $eventManager = EventManager::getInstance();

        // Обработчик для добавления элемента
        $eventManager->addEventHandler(
            'highloadblock',
            'OnAfterHighloadBlockAdd',
            [$this, 'onAfterHighloadBlockChangeHandler']
        );

        // Обработчик для обновления элемента
        $eventManager->addEventHandler(
            'highloadblock',
            'OnAfterHighloadBlockUpdate',
            [$this, 'onAfterHighloadBlockChangeHandler']
        );

        // Обработчик для удаления элемента
        $eventManager->addEventHandler(
            'highloadblock',
            'OnAfterHighloadBlockDelete',
            [$this, 'onAfterHighloadBlockDeleteHandler']
        );
    }


    // Обработчик события добавления или обновления элемента
    public function onAfterHighloadBlockChangeHandler(\Bitrix\Main\Event $event): void
    {
        // Получаем название таблицы
        $tableName = $event->getParameter('TABLE_NAME');

        // Используем метод AgentsList для сброса кеша
        $this->agentsList->clearCacheByTableName($tableName);

        // Обновляем массив агентов
        $this->agentsList->getAgents();
    }

    // Обработчик события удаления элемента
    public function onAfterHighloadBlockDeleteHandler(\Bitrix\Main\Event $event): void
    {
        // Получаем название таблицы
        $tableName = $event->getParameter('TABLE_NAME');

        // Используем метод AgentsList для сброса кеша
        $this->agentsList->clearCacheByTableName($tableName);

        // Обновляем массив агентов
        $this->agentsList->getAgents();
    }
}
