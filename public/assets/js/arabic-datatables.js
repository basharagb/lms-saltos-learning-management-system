// Arabic localization for DataTables - Complete English Override
$(document).ready(function() {
    // Wait a bit to ensure DataTables are fully initialized
    setTimeout(function() {
        // Override DataTables default language settings with Arabic
        $.extend($.fn.dataTable.defaults, {
            language: {
                "sProcessing": "جاري المعالجة...",
                "sLengthMenu": "أظهر _MENU_ سجل",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
                "sInfoEmpty": "إظهار 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(تم تصفية من أصل _MAX_ سجل)",
                "sInfoPostFix": "",
                "sSearch": "البحث:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "جاري التحميل...",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                },
                "oAria": {
                    "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                    "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                },
                "buttons": {
                    "copy": "نسخ",
                    "excel": "إكسل",
                    "csv": "CSV",
                    "pdf": "PDF",
                    "print": "طباعة",
                    "colvis": "إظهار الأعمدة",
                    "collection": "مجموعة",
                    "copyTitle": "نسخ إلى الحافظة",
                    "copyKeys": "اضغط Ctrl أو Cmd + C للنسخ",
                    "copySuccess": {
                        "1": "تم نسخ صف واحد",
                        "_": "تم نسخ %d صفوف"
                    },
                    "print": "طباعة",
                    "printTitle": "طباعة الجدول",
                    "printMessage": "اضغط Ctrl أو Cmd + P للطباعة"
                },
                "decimal": ".",
                "thousands": ",",
                "searchBuilder": {
                    "add": "إضافة شرط",
                    "button": {
                        "_": "منشئ البحث (%d)",
                        "0": "منشئ البحث"
                    },
                    "clearAll": "مسح الكل",
                    "condition": "الشرط",
                    "data": "البيانات",
                    "deleteTitle": "حذف الشرط",
                    "leftTitle": "معايير اليسار",
                    "logicAnd": "و",
                    "logicOr": "أو",
                    "rightTitle": "معايير اليمين",
                    "title": {
                        "_": "منشئ البحث (%d)",
                        "0": "منشئ البحث"
                    },
                    "value": "القيمة",
                    "conditions": {
                        "date": {
                            "after": "بعد",
                            "before": "قبل",
                            "between": "بين",
                            "empty": "فارغ",
                            "equals": "يساوي",
                            "not": "لا يساوي",
                            "notBetween": "لا بين",
                            "notEmpty": "غير فارغ"
                        },
                        "number": {
                            "between": "بين",
                            "empty": "فارغ",
                            "equals": "يساوي",
                            "gt": "أكبر من",
                            "gte": "أكبر من أو يساوي",
                            "lt": "أقل من",
                            "lte": "أقل من أو يساوي",
                            "not": "لا يساوي",
                            "notBetween": "لا بين",
                            "notEmpty": "غير فارغ"
                        },
                        "string": {
                            "contains": "يحتوي على",
                            "empty": "فارغ",
                            "endsWith": "ينتهي بـ",
                            "equals": "يساوي",
                            "not": "لا يساوي",
                            "notEmpty": "غير فارغ",
                            "startsWith": "يبدأ بـ"
                        }
                    }
                }
            }
        });

        // Override specific DataTables instances that might have hardcoded English
        if ($.fn.DataTable) {
            // Override any existing DataTables
            $('.datatable-button-html5-columns').each(function() {
                var table = $(this).DataTable();
                if (table) {
                    table.language({
                        "sProcessing": "جاري المعالجة...",
                        "sLengthMenu": "أظهر _MENU_ سجل",
                        "sZeroRecords": "لم يعثر على أية سجلات",
                        "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                        "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
                        "sInfoEmpty": "إظهار 0 إلى 0 من أصل 0 سجل",
                        "sInfoFiltered": "(تم تصفية من أصل _MAX_ سجل)",
                        "sSearch": "البحث:",
                        "oPaginate": {
                            "sFirst": "الأول",
                            "sPrevious": "السابق",
                            "sNext": "التالي",
                            "sLast": "الأخير"
                        }
                    });
                }
            });
        }
    }, 500);

    // Override DataTables language globally for any new instances
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            "sProcessing": "جاري المعالجة...",
            "sLengthMenu": "أظهر _MENU_ سجل",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
            "sInfoEmpty": "إظهار 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(تم تصفية من أصل _MAX_ سجل)",
            "sSearch": "البحث:",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        }
    });
});

// Function to reinitialize DataTables with Arabic language
function reinitializeDataTablesArabic() {
    if ($.fn.DataTable) {
        $('.datatable-button-html5-columns').each(function() {
            var table = $(this).DataTable();
            if (table) {
                table.language({
                    "sProcessing": "جاري المعالجة...",
                    "sLengthMenu": "أظهر _MENU_ سجل",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    "sInfoEmpty": "إظهار 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(تم تصفية من أصل _MAX_ سجل)",
                    "sSearch": "البحث:",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                });
            }
        });
    }
}

// Call this function after any AJAX content updates
$(document).on('ajaxComplete', function() {
    setTimeout(reinitializeDataTablesArabic, 100);
});
