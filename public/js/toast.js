document.addEventListener('DOMContentLoaded', function() {

    const toastTrigger = document.getElementById('liveToastBtn');
    const toastLiveExample = document.getElementById('liveToast');
                
    if (toastTrigger) {
        const toastBootstrap = new bootstrap.Toast(toastLiveExample);
        toastTrigger.addEventListener('click', () => {
            toastBootstrap.show();
        })
    }            



// 獲取容器元素 0-1~6-9
var checkboxContainer = document.getElementById("checkboxContainer");


// 循環生成複選框
for (var j = 1; j <= 9; j++) {
    for (var i = 0; i <= 6; i++) {
        var checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.className = "form-check-input";
        checkbox.id = "period" + i + "_" + j;
        checkbox.value = i + "-" + j;

        var label = document.createElement("label");
        label.className = "form-check-label";
        label.htmlFor = "period" + i + "_" + j;
        label.appendChild(document.createTextNode(i + "-" + j));

        var div = document.createElement("div");
        div.className = "form-check form-check-inline";
        div.appendChild(checkbox);
        div.appendChild(label);
        if (i === 0 && 1 < j && j <= 9) {
            checkboxContainer.appendChild(document.createElement("hr"));
        }
        checkboxContainer.appendChild(div);
    }
    
}                                
checkboxContainer.appendChild(document.createElement("hr"));


// 獲取容器元素 0-A ~ 6-c
var checkboxContainer = document.getElementById("checkboxContainer");
                                    
// 時段的字母
var periods = ['A', 'B', 'C'];
                                    
// 循環生成複選框
for (var j = 0; j < periods.length; j++) {
    for (var i = 0; i <= 6; i++) {
        var checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.className = "form-check-input";
        checkbox.id = "period" + i + "_" + periods[j];
        checkbox.value = i + "-" + periods[j];

        var label = document.createElement("label");
        label.className = "form-check-label";
        label.htmlFor = "period" + i + "_" + periods[j];
        label.appendChild(document.createTextNode(i + "-" + periods[j]));

        var div = document.createElement("div");
        div.className = "form-check form-check-inline";
        div.appendChild(checkbox);
        div.appendChild(label);

        checkboxContainer.appendChild(div);

        // 在每組複選框之間添加換行
        if (i === 6 ) {
            checkboxContainer.appendChild(document.createElement("hr"));
        }
    }
}                                                                 

// 點擊輸入框跳出吐司
// 獲取輸入框和 Toast 的元素
const inputBox = document.getElementById('selectedPeriods');
                
// 添加點擊事件監聽器
inputBox.addEventListener('click', function() {
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    toastBootstrap.show();
});



//
document.getElementById("submit-btn").onclick = function() {showSelectedPeriods()};
function showSelectedPeriods() {

    var selectedPeriods = [];
    var periodCheckboxes = document.querySelectorAll('input[type="checkbox"]');
    
    periodCheckboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedPeriods.push(checkbox.value);
        }
    });

    var selectedPeriodsInput = document.getElementById("selectedPeriods");
    selectedPeriodsInput.value = selectedPeriods.join(", ");

}

document.getElementById("submit-btn").onclick = function() {confirmSelection()};
function confirmSelection() {
    var selectedPeriods = [];
    $('input[type="checkbox"]:checked').each(function() {
        selectedPeriods.push($(this).val());
    });

    var selectedPeriodsInput = document.getElementById("selectedPeriods");
    selectedPeriodsInput.value = selectedPeriods.join(", ");

    toastLiveExample.classList.remove('show');
}

});