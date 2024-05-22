$(document).ready(function() {
    const coursesPerPage = 15;
    let data = {};
    let filteredData = [];
    let totalPages = 0;

    // 從data.json載入資料
    $.getJSON('/proncu/public/js/data.json', function(response) {
        data = response;
        filteredData = data.courses;

        // 初始化學院選單
        data.colleges.forEach(college => {
            $('#college-dropdown').append(`<option value="${college.collegeId}">${college.collegeName}</option>`);
        });

        // 初始化顯示所有課程
        // call function displayCourses
        displayCourses(filteredData);
    });

    // 顯示課程
    function displayCourses(courses, page = 1) {
        // 從第n筆到第n+15筆
        const startIndex = (page - 1) * coursesPerPage;
        const endIndex = startIndex + coursesPerPage;
        const paginatedCourses = courses.slice(startIndex, endIndex);

        $("#course-list").children().not('#course-nav').remove();

        // 將15筆課程信息添加到 course-list
        paginatedCourses.forEach(course => {
            // 確保 classTimes 是一個陣列並進行格式化
            var formattedClassTimes = Array.isArray(course.classTimes) 
                                        ? course.classTimes.join(", ") 
                                        : "";

            // 將課程信息添加到 course-list
            var parent = $("<div>").addClass("row");
            parent.append(
                $("<div>").addClass("col").html(course.classNo),
                $("<div>").addClass("col").html(course.title),
                $("<div>").addClass("col").html(course.courseType),
                $("<div>").addClass("col").html(course.credit),
                $("<div>").addClass("col").html(course.teachers.join(", ")),
                $("<div>").addClass("col").html(formattedClassTimes),
                $("<div>").addClass("col").append(
                    $("<div>").addClass("btn-group dropend").append(
                        $("<button>").attr({
                            type: "button",
                            class: "btn btn-secondary dropdown-toggle",
                            "data-bs-toggle": "dropdown",
                            "aria-expanded": "false"
                        }).text("加入"),
                        $("<ul>").addClass("dropdown-menu").append(
                            $("<li>").append(
                                $("<a>").addClass("dropdown-item").attr("href", "#").text("112-2")
                            ),
                            $("<li>").append(
                                $("<a>").addClass("dropdown-item").attr("href", "#").text("113-1")
                            ),
                            $("<li>").append(
                                $("<a>").addClass("dropdown-item").attr("href", "#").text("...")
                            )
                        )
                    )
                )
            );
            $('#course-list').append(parent);
        });

        //show一頁課程改變一次分頁按鈕
        displayPagination(courses.length, page);
        $('#total-count').text(courses.length);
    }


    // 顯示分頁按鈕
    function displayPagination(totalCourses, currentPage) {
        const totalPages = Math.ceil(totalCourses / coursesPerPage);
        $('.pagination').empty();
    
        const groupSize = 5;
        const groupIndex = Math.floor((currentPage - 1) / groupSize);
    
        // 開始頁數和結束頁數
        let startPage = groupIndex * groupSize + 1;
        let endPage = startPage + groupSize - 1;
        if (endPage > totalPages) {
            endPage = totalPages;
        }
    
        // 向左導航按鈕
        if (groupIndex > 0) {
            let prevItem = $("<li>").addClass("page-item").append(
                $("<a>").addClass("page-link").attr("href", "#").html("&laquo;").on("click", function(e) {
                    e.preventDefault();
                    currentPage = startPage - 1;
                    displayPagination(totalCourses, currentPage);
                    displayCourses(filteredData, currentPage);
                })
            );
            $(".pagination").append(prevItem);
        }
    
        // 頁碼按鈕
        for (let i = startPage; i <= endPage; i++) {
            let pageItem = $("<li>").addClass("page-item").append(
                $("<a>").addClass("page-link").attr("href", "#").text(i).on("click", function(e) {
                    e.preventDefault();
                    currentPage = i;
                    displayCourses(filteredData, currentPage);
                    displayPagination(totalCourses, currentPage);
                })
            );
    
            if (i === currentPage) {
                pageItem.addClass("active");
            }
    
            $(".pagination").append(pageItem);
        }
    
        // 向右導航按鈕
        if (endPage < totalPages) {
            let nextItem = $("<li>").addClass("page-item").append(
                $("<a>").addClass("page-link").attr("href", "#").html("&raquo;").on("click", function(e) {
                    e.preventDefault();
                    currentPage = endPage + 1;
                    displayPagination(totalCourses, currentPage);
                    displayCourses(filteredData, currentPage);
                })
            );
            $(".pagination").append(nextItem);
        }
    }
    
    // 分頁按鈕點擊事件
    $('.pagination').on('click', 'button', function() {
        const page = $(this).data('page');
        displayCourses(filteredData, page);
    });

    // 更新系所選單
    function updateDepartments(collegeId) {
        const departments = data.departments.filter(dept => dept.collegeId === collegeId);
        $('#department-dropdown').empty().append('<option value="">選擇系所</option>');
        departments.forEach(department => {
            $('#department-dropdown').append(`<option value="${department.departmentId}">${department.departmentName}</option>`);
        });
    }

    // 根據學院篩選課程
    $('#college-dropdown').change(function() {
        const selectedCollegeId = $(this).val();
        filteredData = selectedCollegeId ? data.courses.filter(course => course.collegeIds.includes(selectedCollegeId)) : data.courses;
        updateDepartments(selectedCollegeId);
        displayCourses(filteredData);
    });

    // 根據系所篩選課程
    $('#department-dropdown').change(function() {
        const selectedDepartmentId = $(this).val();
        filteredData = selectedDepartmentId ? filteredData.filter(course => course.departmentIds.includes(selectedDepartmentId)) : filteredData;
        displayCourses(filteredData);
    });


    // 分頁按鈕點擊事件
    $('.pagination').on('click', 'button', function() {
        const page = $(this).data('page');
        displayCourses(filteredData, page);
    });

    // 監聽輸入事件
    $('.form-control').on('input', function() {
        const courseName = $('.course-name-filter').val().trim().toLowerCase();
        const teacherName = $('.teacher-filter').val().trim().toLowerCase();
        const classNo = $('.class-no-filter').val().trim().toLowerCase();
        // const classPeriod = $('.class-period-filter').val().trim().toLowerCase();

        // 根據輸入內容過濾課程
        filteredData = data.courses.filter(course => {
            return course.title.toLowerCase().includes(courseName) &&
                course.teachers.some(teacher => teacher.toLowerCase().includes(teacherName)) &&
                course.classNo.toLowerCase().includes(classNo);
        });

        // 顯示過濾後的課程
        displayCourses(filteredData);
    });

});