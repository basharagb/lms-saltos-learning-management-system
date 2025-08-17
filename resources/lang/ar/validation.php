<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute ليس رابطاً صحيحاً.',
    'after'                => 'يجب أن يكون :attribute تاريخاً بعد :date.',
    'after_or_equal'       => 'يجب أن يكون :attribute تاريخاً بعد أو يساوي :date.',
    'alpha'                => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash'           => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array'                => 'يجب أن يكون :attribute مصفوفة.',
    'before'               => 'يجب أن يكون :attribute تاريخاً قبل :date.',
    'before_or_equal'      => 'يجب أن يكون :attribute تاريخاً قبل أو يساوي :date.',
    'between'              => [
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute بين :min و :max حرف.',
        'array'   => 'يجب أن يحتوي :attribute على :min إلى :max عنصر.',
    ],
    'boolean'              => 'يجب أن يكون حقل :attribute صحيح أو خطأ.',
    'confirmed'            => 'تأكيد :attribute غير متطابق.',
    'date'                 => ':attribute ليس تاريخاً صحيحاً.',
    'date_format'          => ':attribute لا يطابق الصيغة :format.',
    'different'            => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits'               => 'يجب أن يكون :attribute :digits رقم.',
    'digits_between'       => 'يجب أن يكون :attribute بين :min و :max رقم.',
    'dimensions'           => ':attribute يحتوي على أبعاد صورة غير صحيحة.',
    'distinct'             => 'حقل :attribute يحتوي على قيمة مكررة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح.',
    'exists'               => ':attribute المحدد غير صحيح.',
    'file'                 => 'يجب أن يكون :attribute ملف.',
    'filled'               => 'حقل :attribute يجب أن يحتوي على قيمة.',
    'gt'                   => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أكبر من :value حرف.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
        'file'    => 'يجب أن يكون :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أكبر من أو يساوي :value حرف.',
        'array'   => 'يجب أن يحتوي :attribute على :value عنصر أو أكثر.',
    ],
    'image'                => 'يجب أن يكون :attribute صورة.',
    'in'                   => ':attribute المحدد غير صحيح.',
    'in_array'             => 'حقل :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute رقم صحيح.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيح.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيح.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيح.',
    'json'                 => 'يجب أن يكون :attribute نص JSON صحيح.',
    'lt'                   => [
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'file'    => 'يجب أن يكون :attribute أقل من :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أقل من :value حرف.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
        'file'    => 'يجب أن يكون :attribute أقل من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أقل من أو يساوي :value حرف.',
        'array'   => 'يجب ألا يحتوي :attribute على أكثر من :value عنصر.',
    ],
    'max'                  => [
        'numeric' => 'يجب ألا يكون :attribute أكبر من :max.',
        'file'    => 'يجب ألا يكون :attribute أكبر من :max كيلوبايت.',
        'string'  => 'يجب ألا يكون :attribute أكبر من :max حرف.',
        'array'   => 'يجب ألا يحتوي :attribute على أكثر من :max عنصر.',
    ],
    'mimes'                => 'يجب أن يكون :attribute ملف من نوع: :values.',
    'mimetypes'            => 'يجب أن يكون :attribute ملف من نوع: :values.',
    'min'                  => [
        'numeric' => 'يجب أن يكون :attribute على الأقل :min.',
        'file'    => 'يجب أن يكون :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute على الأقل :min حرف.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عنصر.',
    ],
    'not_in'               => ':attribute المحدد غير صحيح.',
    'not_regex'            => 'صيغة :attribute غير صحيحة.',
    'numeric'              => 'يجب أن يكون :attribute رقم.',
    'present'              => 'حقل :attribute يجب أن يكون موجود.',
    'regex'                => 'صيغة :attribute غير صحيحة.',
    'required'             => 'حقل :attribute مطلوب.',
    'required_if'          => 'حقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_unless'      => 'حقل :attribute مطلوب ما لم يكن :other في :values.',
    'required_with'        => 'حقل :attribute مطلوب عندما يكون :values موجود.',
    'required_with_all'    => 'حقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_without'     => 'حقل :attribute مطلوب عندما لا يكون :values موجود.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا تكون أي من :values موجودة.',
    'same'                 => 'يجب أن يتطابق :attribute و :other.',
    'size'                 => [
        'numeric' => 'يجب أن يكون :attribute :size.',
        'file'    => 'يجب أن يكون :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute :size حرف.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصر.',
    ],
    'string'               => 'يجب أن يكون :attribute نص.',
    'timezone'             => 'يجب أن يكون :attribute منطقة زمنية صحيحة.',
    'unique'               => ':attribute مُستخدم من قبل.',
    'uploaded'             => 'فشل في رفع :attribute.',
    'url'                  => 'صيغة :attribute غير صحيحة.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                  => 'الاسم',
        'username'              => 'اسم المستخدم',
        'email'                 => 'البريد الإلكتروني',
        'first_name'            => 'الاسم الأول',
        'last_name'             => 'اسم العائلة',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'البلد',
        'address'               => 'العنوان',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'title'                 => 'العنوان',
        'content'               => 'المحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المقتطف',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'متاح',
        'size'                  => 'الحجم',
    ],

];
