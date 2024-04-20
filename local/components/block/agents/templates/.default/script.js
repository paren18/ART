BX.ready(function() {
    // Получаем все DOM-элементы с классом star
    let stars = document.querySelectorAll('.star');
    // Повешаем обработчик события click на каждую звездочку
    stars.forEach(function(star) {
        BX.bind(star, 'click', clickStar);
    });
});

function clickStar(event) {
    event.preventDefault(); // Отменяем стандартное действие при клике на ссылку
    console.log("Click event triggered"); // Добавим сообщение для отладки
    // Получаем ID агента из атрибута data-agent-id
    let agentID = this.dataset.agentId;
    console.log("Agent ID:", agentID); // Выведем agentID для отладки
    if (agentID) { // Если ID агента существует
        // Делаем AJAX-запрос к контроллеру событий на бэкенде
        BX.ajax.runComponentAction(
            'block:agents', // Название компонента
            'clickStar', // Название метода на бэкенде
            {
                mode: 'class', // Режим выполнения (вызов метода из класса)
                data: { agentID: agentID } // Передаем ID агента на бэкенд
            }
        )
            .then(function(response) {
                console.log(response); // Логируем ответ для отладки
                let data = response.data;
                if (data['action'] === 'success') {
                    // Проверяем, есть ли уже класс active у элемента
                    if (this.classList.contains('active')) {
                        // Если есть, удаляем его
                        this.classList.remove('active');
                    } else {
                        // Если нет, добавляем
                        this.classList.add('active');
                    }
                }
            }.bind(this)) // Привязываем контекст выполнения функции к текущему элементу
            .catch(function(response) {
                console.error(response.errors); // Логируем ошибки для отладки
            });
    }
}
