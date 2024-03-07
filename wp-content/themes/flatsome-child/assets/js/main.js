jQuery(document).ready(function($) {
    // Tạo một MutationObserver
    const observer = new MutationObserver(function(mutationsList) {
        for (const mutation of mutationsList) {
            if (mutation.target.classList.contains('accordion-inner')) {
                const currentDisplayValue = $(mutation.target).css('display');
            
                if ('block' == currentDisplayValue) {
                    // Áp dụng viền màu đỏ cho phần tử cha của phần tử có class 'accordion-inner'
                    $(mutation.target).parent().css('border', '0.5px solid var(--primary-color)');
                }else{
                    $(mutation.target).parent().css('border', '');
                }
            }
        }
    });

    // Bắt đầu giám sát sự kiện thay đổi trong DOM
    observer.observe(document.body, {
        subtree: true,
        attributes: true,
        attributeFilter: ['style'],
        childList: true
    });
})