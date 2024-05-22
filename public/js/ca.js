let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();
let events = {};

function getDaysInMonth(year, month) {
    return new Date(year, month + 1, 0).getDate();
}

function getFirstDayOfMonth(year, month) {
    return new Date(year, month, 1).getDay();
}

function loadEvents() {
    fetch('/proncu/public/calendar/events')
        .then(response => response.json())
        .then(data => {
            events = {}; // 重置事件数据
            data.forEach(event => {
                const eventDate = new Date(event.end_time);
                const year = eventDate.getFullYear();
                const month = eventDate.getMonth();
                const day = eventDate.getDate();
                const key = `${year}-${month}-${day}`;
                console.log(eventDate);
                if (!events[key]) {
                    events[key] = [];
                }
                events[key].push(event.events_name);
            });
            updateCalendar(currentYear, currentMonth); // 更新日历
        })
        .catch(error => console.error('Error loading events:', error));
}

function updateCalendar(year, month) {
    const monthYearDisplay = document.getElementById('month-year');
    const daysGrid = document.getElementById('days-grid');

    let firstDay = new Date(year, month, 1).getDay();
    let adjustedFirstDay = firstDay === 0 ? 6 : firstDay - 1;
    let daysInMonth = new Date(year, month + 1, 0).getDate();
    let daysInPrevMonth = month === 0 ? new Date(year - 1, 12, 0).getDate() : new Date(year, month, 0).getDate();

    monthYearDisplay.textContent = `${year}年 ${month + 1}月`;
    daysGrid.innerHTML = '';

    for (let i = 0; i < adjustedFirstDay; i++) {
        let cell = document.createElement('div');
        cell.className = 'empty';
        cell.textContent = daysInPrevMonth - adjustedFirstDay + i + 1;
        daysGrid.appendChild(cell);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        let cell = document.createElement('div');
        cell.textContent = day;
        cell.className = 'day-cell';

        let eventsContainer = document.createElement('div');
        eventsContainer.className = 'events-container';
        cell.appendChild(eventsContainer);

        const key = `${year}-${month}-${day}`;
        if (events[key]) {
            events[key].forEach(event => {
                let eventNode = document.createElement('div');
                eventNode.className = 'event';
                eventNode.textContent = event;
                eventsContainer.appendChild(eventNode);
            });
        }

        daysGrid.appendChild(cell);
    }

    let fillDays = (7 - ((adjustedFirstDay + daysInMonth) % 7)) % 7;
    for (let i = 1; i <= fillDays; i++) {
        let cell = document.createElement('div');
        cell.className = 'empty';
        cell.textContent = i;
        daysGrid.appendChild(cell);
    }
    
}

function showDayEvents(year, month, day) {
    const eventModal = document.getElementById('eventModal');
    const eventList = document.getElementById('eventList');
    const newEventText = document.getElementById('newEventText');

    eventList.innerHTML = '';
    newEventText.value = '';

    if (events[`${year}-${month}-${day}`]) {
        events[`${year}-${month}-${day}`].forEach(event => {
            const eventDiv = document.createElement('div');
            eventDiv.textContent = event;
            eventDiv.className = 'event';
            eventDiv.onclick = function () {
                if (confirm('Delete this event?')) {
                    removeEvent(year, month, day, event);
                    showDayEvents(year, month, day);
                }
            };
            eventList.appendChild(eventDiv);
        });
    }

    newEventText.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            addNewEvent();
        }
    });

    window.addNewEvent = function () {
        const eventText = newEventText.value.trim();
        if (eventText) {
            if (!events[`${year}-${month}-${day}`]) {
                events[`${year}-${month}-${day}`] = [];
            }
            events[`${year}-${month}-${day}`].push(eventText);
            saveEvents(); // 確保事件被保存
            updateCalendar(year, month);
            showDayEvents(year, month, day);
            closeModal(); // 添加事件後關閉模態框
        }
    };

    eventModal.style.display = 'block';
}

function closeModal() {
    document.getElementById('eventModal').style.display = 'none';
}





loadEvents();
