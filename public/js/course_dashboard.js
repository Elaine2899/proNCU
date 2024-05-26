
// 監聽網頁加載完成事件
document.addEventListener('DOMContentLoaded', function() {

    // 從 data.json 載入資料
    $.getJSON('/proncu/public/js/data.json', function(response) {
        filteredData = response.courses;
        
        // 從後端獲取課程資料
        $.ajax({
            url: '/proncu/public/course/dashboard/my',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {                
                renderCourses(response, filteredData);
                updateProgressBars(response, filteredData);
                updateDonutChart(response, filteredData)
            }
        });
    });
});


function renderCourses(courses, filteredData){

    const courseList = document.getElementById('course-list');
            const categories = ['必修', '系選修', '通識', '外系選修', '體育'];
            const dropdownCategories = ['通識', '外系選修'];

            categories.forEach(category => {
                // 創建類別標題
                let categoryTitle = document.createElement('h4');
                categoryTitle.classList.add('dashBoard_class_h4');
                categoryTitle.innerText = category;
                courseList.appendChild(categoryTitle);

                // 創建課程列表容器
                let categoryContainer = document.createElement('div');
                categoryContainer.classList.add('category-container');
                courseList.appendChild(categoryContainer);

                 // 添加課程標題行
                 let rowTitle = document.createElement('div');
                 rowTitle.classList.add('row', 'dashBoard_class_row', 'rowtitle');
                 rowTitle.innerHTML = `
                     <div class="col"><strong>課號</strong></div>
                     <div class="col"><strong>課程名稱</strong></div>
                     <div class="col"><strong>學分</strong></div>
                     <div class="col"><strong>授課老師</strong></div>
                     <div class="col"><strong>修課學期</strong></div>
                     <div class="col"><strong>更改課別</strong></div>
                 `;
                 categoryContainer.appendChild(rowTitle);

                 // 添加課程資料
                 courses.forEach(course => {
                    const courseNo = course.courseNo;
                    const courseData = filteredData.find(c => c.classNo === courseNo);
                    const courseCategory = course.category;

                    if(courseCategory === category){
                        // 創建 courseRowContainer
                        let courseRowContainer = document.createElement('div');
                        courseRowContainer.classList.add('course-row-container');

                        // 創建課程資料行
                        let courseRow = document.createElement('div');
                        courseRow.classList.add('row', 'dashBoard_class_row');
                    
                        courseRow.innerHTML = `
                        <div class="col">${courseData.classNo}</div>
                        <div class="col">${courseData.title}</div>
                        <div class="col">${courseData.credit}</div>
                        <div class="col">${courseData.teachers}</div>
                        <div class="col">${course.semester}</div>
                        `;
                        
                        if(courseCategory === '通識'){
                            courseRow.innerHTML += `
                            <div class="col">
                                <div class="btn-group dropend">
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">更改課別</button>
                                    <ul class="dropdown-menu">
                                    ${dropdownCategories.map(cat => `<li><a class="dropdown-item" onclick="changeCourseCategory('${courseNo}','${cat}')">${cat}</a></li>`).join('')}
                                    
                                    </ul>
                                </div>
                            </div>
                            `;
                        }
                        else{
                            courseRow.innerHTML += `
                            <div class="col">
                                --
                            </div>
                            `;
                        }
                        // 將 courseRow 添加到 courseRowContainer
                        courseRowContainer.appendChild(courseRow);
                        // 將 courseRowContainer 添加到 categoryContainer
                        categoryContainer.appendChild(courseRowContainer);
                    }
                });
            })

}

function changeCourseCategory(Course, Category){

    // 從後端獲取課程資料
    $.ajax({
        url: '/proncu/public/course/change',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            courseNo: Course,
            courseCategory: Category
        },
        success: function() {                
            location.reload();
        }
    });


}

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

// 更新圓形圖表的函數
function updateDonutChart(courses, filteredData) {
    let credits = 0;
        // 遍歷課程數據，累加各類型課程的學分
    courses.forEach(course => {
        const courseNo = course.courseNo;
        const courseData = filteredData.find(c => c.classNo === courseNo);
        credits += courseData.credit;
            
    });

    // 获取要更新的 <h3> 元素
    const h3Element = document.getElementById('dashBoard_h3');

    // 更新 <h3> 元素的内容
    h3Element.innerHTML = '已修得總學分 <br>' + credits + ' / 128';

    
    const ctx = document.getElementById('myDonutChart').getContext('2d'); // 獲取圓形圖表的繪圖上下文
    new Chart(ctx, {
        type: 'doughnut', // 圖表類型
        data: {
            datasets: [{
                data: [credits,100], // 圖表數據
                backgroundColor: [
                    'rgb(110,109,74,0.8)',
                    'rgb(65,72,51,0.3)',
                ],
                borderColor: [
                    'rgb(110,109,74,0.8)',
                    'rgb(65,72,51,0.3)',
                ],
                
                borderWidth: 1,
                
            }]
        },
        options: {
            cutout: '90%', // 中間空白部分的大小
        },
        plugins: {
            tooltip: {
                enabled: false
            },
            legend: {
                display: false
            }
        }
        
    });
}