document.addEventListener('DOMContentLoaded', function() {
    const day = 7;
    const period = 13;
    let filteredData = [];

    

    // 初始化課表
    renderCourseTable(day, period);

    // 從 data.json 載入資料
    $.getJSON('/proncu/public/js/data.json', function(response) {
        filteredData = response.courses;
        
        // 從後端獲取課程資料
        $.ajax({
            url: '/proncu/public/course/table/my',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                renderCourses(response, filteredData);
            }
        });
    });
});

function renderCourseTable(day, period) {
    const courseGrid = document.getElementById('course_grid');
    if (courseGrid) {
        courseGrid.innerHTML = ''; // 清空 tbody 中的內容
        // 這裡可以添加課程資料到 tbody 中
        for (let i = 0; i < period; i++) {
            let row = document.createElement('tr'); // 創建 tr 元素，代表一行

            for (let j = 0; j <= day; j++) {
                let cell = document.createElement('td'); // 創建 td 元素

                if (j === 0) { // 每列的第一格印第幾節
                    if (i >= 0 && i < 4) {
                        cell.textContent = i + 1;
                    } else if (i == 4) {
                        cell.textContent = "Z";
                    } else if (i > 4 && i < 10) {
                        cell.textContent = i;
                    } else if (i == 10) {
                        cell.textContent = "A";
                    } else if (i == 11) {
                        cell.textContent = "B";
                    } else if (i == 12) {
                        cell.textContent = "C";
                    }
                } else {
                    cell.textContent = ''; // 其他列的初始內容為空
                }

                row.appendChild(cell); // 將 td 元素添加到 tr 元素中
            }

            courseGrid.appendChild(row); // 將 tr 元素添加到 tbody 中，表示新增一行
        }
    }
}

function renderCourses(courses, filteredData) {
    const courseGrid = document.getElementById('course_grid');
    const periods = ['1', '2', '3', '4', 'Z', '5', '6', '7', '8', '9', 'A', 'B', 'C'];

    if (courseGrid) {
        courses.forEach(course => {
            const courseNo = course.courseNo;
            const courseData = filteredData.find(c => c.classNo === courseNo);
                        
            if (courseData && courseData.classTimes) {
                courseData.classTimes.forEach(time => {
                    const [day, period] = time.split('-');
                    
                    const periodIndex = periods.indexOf(period.toString());

                    // 找到与 period 相匹配的行
                    if (periodIndex !== -1) {
                        const row = courseGrid.rows[periodIndex];
                        if (row) {
                            const cell = row.cells[day];
                            if (cell) {
                                cell.textContent = courseData.title + '\r' + courseData.teachers;
                                    // 創建移除課程按鈕
                                    const removeButton = document.createElement('button');
                                    removeButton.textContent = '移除課程';
                                    removeButton.className = 'btn btn-danger btn-sm cancel-btn';
                                    removeButton.addEventListener('click', () => {
                                        // 處理按下按鈕後的邏輯
                                        $.ajax({
                                            url: '/proncu/public/course/delete',
                                            method: 'DELETE',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            data: {
                                                semester: "112-2",
                                                courseNo: courseNo
                                            },
                                            success: function() {
                                                location.reload();
                                            },
                                    
                                        });
                                        // 例如，可以從介面上移除相應的課程
                                    });
                                    cell.appendChild(removeButton);
                            }
                        }
                    }
                });
            } else {
                console.error('Invalid course or classTimes:', course);
            }
        });
    }
}
