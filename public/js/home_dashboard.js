// 監聽網頁加載完成事件
document.addEventListener('DOMContentLoaded', function() {

    // 從 data.json 載入資料
    $.getJSON('/proncu/public/js/data.json', function(response) {
        filteredData = response.courses;
        
        // 從後端獲取課程資料
        $.ajax({
            url: '/proncu/public/home/dashboard',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {                                
                updateProgressBars(response, filteredData);
            }
        });
    });
});


// 更新進度條的函數
function updateProgressBars(courses, filteredData) {
    const limits = {'必修': 86, '系選修': 16, '外系選修': 12, '通識': 14, '體育': 5}; // 各類課程的學分上限
    const credits = {'必修': 0, '系選修': 0, '外系選修': 0, '通識': 0, '體育': 0}; // 初始化學分計數
    

    // 遍歷課程數據，累加各類型課程的學分
    courses.forEach(course => {
        const courseNo = course.courseNo;
        const courseData = filteredData.find(c => c.classNo === courseNo);

        if (courseData && credits.hasOwnProperty(course.category)) {
            credits[course.category] += courseData.credit;
            if(course.category === '體育'){
                credits[course.category]++;
            }    
        }
    });

    // 更新各進度條的顯示
    Object.keys(credits).forEach(type => {
        const progressBar = document.getElementById(`${type}-bar`); // 獲取對應的進度條元素
        if (progressBar) {
            const credit = Math.min(credits[type], limits[type]); // 計算顯示的學分（不超過上限）
            const percentage = (credit / limits[type]) * 100; // 計算完成百分比
            progressBar.style.width = `${percentage}%`; // 設置進度條寬度
            progressBar.textContent = `${credit} / ${limits[type]}`; // 設置進度條文本
        }
    });
}