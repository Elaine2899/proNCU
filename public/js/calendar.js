// public/js/calendar.js

let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();
let events = {};

function getDaysInMonth(year, month) {
    return new Date(year, month + 1, 0).getDate();
}

function getFirstDayOfMonth(year, month) {
    return new Date(year, month, 1).getDay();
}

function updateCalendar(year, month) {
    $.ajax({
        url: '/proncu/public/calendar/events',
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            year: year,
            month: month + 1 // 因为月份是从0开始的，所以加1
        },
        success: function(response) {
            events = {};
            response.forEach(event => {
                
                const eventDate = new Date(event.end_time);
                const year = eventDate.getFullYear();
                const month = eventDate.getMonth() + 1; // 调整月份从 1 开始
                const day = eventDate.getDate();
                
                const key = `${year}-${month}-${day}`;
                if (!events[key]) {
                    events[key] = [];
                }
                events[key].push(event.events_name);
            });
        
            renderCalendar(year, month);
        }
})
}

function renderCalendar(year, month) {
    const monthYearDisplay = document.getElementById('month-year');
    const daysGrid = document.getElementById('days-grid');

    let firstDay = getFirstDayOfMonth(year, month);
    let adjustedFirstDay = firstDay === 0 ? 6 : firstDay - 1;
    let daysInMonth = getDaysInMonth(year, month);
    let daysInPrevMonth = month === 0 ? getDaysInMonth(year - 1, 11) : getDaysInMonth(year, month - 1);

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
        cell.style.height = '107px';
        cell.style.boxSizing = 'border-box';

        let dayOfWeek = (adjustedFirstDay + day - 1) % 7;
        if (dayOfWeek === 5 || dayOfWeek === 6) {
            cell.classList.add('weekend');
        }

        let eventsContainer = document.createElement('div');
        eventsContainer.className = 'events-container';
        cell.appendChild(eventsContainer);

        let key = `${year}-${month+1}-${day}`;
        if (events[key]) {
            
            let displayedEvents = 0;
            events[key].forEach(event => {
                if (displayedEvents < 2) {
                    let eventNode = document.createElement('div');
                    eventNode.className = 'event';
                    eventNode.textContent = event;
                    eventsContainer.appendChild(eventNode);
                    displayedEvents++;
                }
            });
        } else {
            cell.removeChild(eventsContainer);
        }

        cell.onclick = () => showDayEvents(year, month, day);
        daysGrid.appendChild(cell);
    }

    let fillDays = (7 - ((adjustedFirstDay + daysInMonth) % 7)) % 7;
    for (let i = 1; i <= fillDays; i++) {
        let cell = document.createElement('div');
        cell.className = 'empty';
        cell.textContent = i;
        cell.style.height = '107px';
        cell.style.boxSizing = 'border-box';
        daysGrid.appendChild(cell);
    }
}

updateCalendar(currentYear, currentMonth);

function showDayEvents(year, month, day) {
    const eventModal = document.getElementById('eventModal') ;
    const eventList = document.getElementById('eventList') ;
    const newEventText = document.getElementById('newEventText');
     
    eventList.innerHTML = '';
    newEventText.value = '';

    let key = `${year}-${month+1}-${day}`;
    if (events[key]) {
        events[key].forEach(event => {
            
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
            addNewEvent(year, month, day);
        }
    });

    window.addNewEvent = function () {
        const eventText = newEventText.value.trim();
        if (eventText != '') {
            $.ajax({
                url: '/proncu/public/calendar/events',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    date: `${year}-${month + 1}-${day}`,
                    event: eventText
                },
                success: function() {
                    updateCalendar(currentYear, currentMonth);
                    showDayEvents(year, month, day);
                    closeModal();
                }
            });
        }
    };

    eventModal.style.display = 'block';
}

function closeModal() {
    
     // 清空新事件输入框
     document.getElementById('newEventText').value = '';

     // 清空事件列表
     document.getElementById('eventList').innerHTML = '';
 
     // 隐藏模态框
     document.getElementById('eventModal').style.display = 'none';

}

function removeEvent(year, month, day, eventText) {
    $.ajax({
        url: '/proncu/public/calendar/events',
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            date: `${year}-${month + 1}-${day}`,
            event: eventText
        },
        success: function() {
            updateCalendar(currentYear, currentMonth);
            closeModal();
        },

    });
    
}


document.getElementById('prev-month').addEventListener('click', () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    updateCalendar(currentYear, currentMonth);
});

document.getElementById('next-month').addEventListener('click', () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    updateCalendar(currentYear, currentMonth);
});
