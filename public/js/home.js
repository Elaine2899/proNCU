document.addEventListener('DOMContentLoaded', function() {
    
    let objectDate = new Date();

    let day = objectDate.getDate();

    let month = objectDate.getMonth();

    let year = objectDate.getFullYear();

    $.ajax({
        url: '/proncu/public/home/calendar',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            date:`${year}-${month + 1}-${day}`
        },
        success: function(response) {
            getCalendar(response);
        }
    });

});

function getCalendar(event){
    console.log(event);
    // 获取要插入提醒项的容器
    const reminderContainer = document.getElementById('reminder-container');

    // 创建并插入提醒项
    event.forEach((event) => {
        const pElement = document.createElement('p');
        pElement.textContent = `# ${event.events_name}`;
        pElement.classList.add('reminder-item');
        reminderContainer.appendChild(pElement);

    });
}