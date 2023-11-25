<?php

return [
    'admin' => [
        'catalog' => [
            'products' => [
                'booking'                   => 'বুকিং তথ্য',
                'booking-type'              => 'বুকিং টাইপ',
                'default'                   => 'ডিফল্ট',
                'appointment-booking'       => 'অ্যাপয়েন্টমেন্ট বুকিং',
                'event-booking'             => 'ইভেন্ট বুকিং',
                'rental-booking'            => 'ভাড়া বুকিং',
                'table-booking'             => 'টেবিল বুকিং',
                'slot-duration'             => 'স্লটের সময়কাল (মিনিট)',
                'break-time'                => 'বিরতির সময় b/w স্লট (মিনিট)',
                'available-every-week'      => 'প্রতি সপ্তাহে পাওয়া যায়',
                'yes'                       => 'হ্যাঁ',
                'no'                        => 'না',
                'available-from'            => 'থেকে পাওয়া যায়',
                'available-to'              => 'কার্যকর',
                'same-slot-all-days'        => 'সারাদিন একই স্লট',
                'slot-has-quantity'         => 'স্লটে পরিমাণ আছে',
                'slots'                     => 'স্লট',
                'from'                      => 'থেকে',
                'to'                        => 'প্রতি',
                'qty'                       => 'পরিমাণ',
                'add-slot'                  => 'স্লট যোগ করুন',
                'sunday'                    => 'রবিবার',
                'monday'                    => 'সোমবার',
                'tuesday'                   => 'মঙ্গলবার',
                'wednesday'                 => 'বুধবার',
                'thursday'                  => 'বৃহস্পতিবার',
                'friday'                    => 'শুক্রবার',
                'saturday'                  => 'শনিবার',
                'renting-type'              => 'ভাড়ার ধরন',
                'daily'                     => 'দৈনিক ভিত্তিতে',
                'hourly'                    => 'ঘন্টার ভিত্তিতে',
                'daily-hourly'              => 'উভয়ই (দৈনিক এবং ঘন্টাভিত্তিক)',
                'daily-price'               => 'দৈনিক মূল্য',
                'hourly-price'              => 'ঘণ্টায় মূল্য',
                'location'                  => 'অবস্থান',
                'show-location'             => 'অবস্থান দেখান',
                'event-start-date'          => 'ইভেন্ট শুরুর তারিখ',
                'event-end-date'            => 'ইভেন্টের শেষ তারিখ',
                'tickets'                   => 'টিকিট',
                'add-ticket'                => 'টিকিট যোগ করুন',
                'name'                      => 'নাম',
                'price'                     => 'দাম',
                'quantity'                  => 'পরিমাণ',
                'description'               => 'বর্ণনা',
                'special-price'             => 'বিশেষ মূল্য',
                'special-price-from'        => 'বৈধ হবে',
                'special-price-to'          => 'বৈধতার সীমা',
                'charged-per'               => 'প্রতি চার্জ',
                'guest'                     => 'অতিথি',
                'table'                     => 'টেবিল',
                'prevent-scheduling-before' => 'আগে শিডিউল করা প্রতিরোধ করুন',
                'guest-limit'               => 'টেবিল প্রতি অতিথি সীমা',
                'guest-capacity'            => 'গেস্ট ক্যাপাসিটি',
                'type'                      => 'টাইপ',
                'many-bookings-for-one-day' => 'একদিনের জন্য অনেক বুকিং',
                'one-booking-for-many-days' => 'অনেক দিনের জন্য এক বুকিং',
                'day'                       => 'দিন',
                'status'                    => 'স্ট্যাটাস',
                'open'                      => 'খোলা',
                'close'                     => 'বন্ধ',
                'time-error'                => 'সময়ের থেকে সময়ের চেয়ে বড় হতে হবে।',
            ],
        ],

        'sales' => [
            'bookings' => [
                'title'         => 'বুকিং',
                'table-view'    => 'টেবিল ভিউ',
                'calender-view' => 'ক্যালেন্ডার ভিউ',
            ],
        ],

        'datagrid' => [
            'from' => 'থেকে',
            'to'   => 'প্রতি',
        ],
    ],

    'shop' => [
        'products' => [
            'booking-information'      => 'বুকিং তথ্য',
            'location'                 => 'অবস্থান',
            'contact'                  => 'যোগাযোগ',
            'email'                    => 'ইমেইল',
            'slot-duration'            => 'স্লট সময়কাল',
            'slot-duration-in-minutes' => ':minutes মিনিট',
            'today-availability'       => 'আজ প্রাপ্যতা',
            'slots-for-all-days'       => 'সমস্ত দিনের জন্য দেখান',
            'sunday'                   => 'রবিবার',
            'monday'                   => 'সোমবার',
            'tuesday'                  => 'মঙ্গলবার',
            'wednesday'                => 'বুধবার',
            'thursday'                 => 'বৃহস্পতিবার',
            'friday'                   => 'শুক্রবার',
            'saturday'                 => 'শনিবার',
            'closed'                   => 'বন্ধ',
            'book-an-appointment'      => 'সাক্ষাৎকার লিপিবদ্ধ করুন',
            'date'                     => 'তারিখ',
            'slot'                     => 'স্লট',
            'no-slots-available'       => 'কোন স্লট উপলব্ধ',
            'rent-an-item'             => 'একটি আইটেম ভাড়া',
            'choose-rent-option'       => 'ভাড়ার বিকল্প বেছে নিন',
            'daily-basis'              => 'দৈনিক ভিত্তিতে',
            'hourly-basis'             => 'ঘন্টার ভিত্তিতে',
            'select-time-slot'         => 'সময় স্লট নির্বাচন করুন',
            'select-slot'              => 'স্লট নির্বাচন করুন',
            'select-date'              => 'তারিখ নির্বাচন করুন',
            'select-rent-time'         => 'ভাড়ার সময় নির্বাচন করুন',
            'from'                     => 'থেকে',
            'to'                       => 'প্রতি',
            'book-a-table'             => 'একটি টেবিল বুক করুন',
            'special-notes'            => 'বিশেষ অনুরোধ/নোট',
            'event-on'                 => 'ইভেন্ট চালু',
            'book-your-ticket'         => 'আপনার টিকিট বুক করুন',
            'per-ticket-price'         => ':price টিকিট প্রতি',
            'number-of-tickets'        => 'টিকিটের সংখ্যা',
            'total-tickets'            => 'মোট টিকিট',
            'base-price'               => 'মুলদাম',
            'total-price'              => 'মোট দাম',
            'base-price-info'          => '(এটি প্রতিটি পরিমাণের জন্য প্রতিটি ধরণের টিকিটের ক্ষেত্রে প্রযোজ্য হবে)',
        ],

        'cart' => [
            'renting_type' => 'ভাড়ার ধরন',
            'daily'        => 'দৈনিক',
            'hourly'       => 'ঘণ্টায়',
            'event-ticket' => 'ইভেন্ট টিকেট',
            'event-from'   => 'ইভেন্ট থেকে',
            'event-till'   => 'ইভেন্ট টিল',
            'rent-type'    => 'ভাড়ার ধরন',
            'rent-from'    => 'থেকে ভাড়া',
            'rent-till'    => 'পর্যন্ত ভাড়া',
            'booking-from' => 'থেকে বুকিং',
            'booking-till' => 'পর্যন্ত বুকিং',
            'special-note' => 'বিশেষ অনুরোধ/নোট',
        ],
    ],
];
