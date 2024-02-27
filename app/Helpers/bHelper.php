<?php

namespace App\Helpers;

class bHelper
{
    public static function location_page()
    {
        $data = [
            '0' => 'Tümü',
            '1' => 'Üst Menu',
            '2' => 'Footer',
            '3' => 'Topbar',
        ];

        return $data;
    }

    public static function neighbourhood()
    {
        $data = [
            '1' => 'Akalan',
            '2' => 'Atatürk',
            '3' => 'Aydınlar',
            '4' => 'Bahşayiş',
            '5' => 'Başak',
            '6' => 'Belgrat',
            '7' => 'Celepköy',
            '8' => 'Çakıl',
            '9' => 'Çanakça',
            '10' => 'Çiftikköy',
            '11' => 'Dağyenice',
            '12' => 'Elbasan',
            '13' => 'Fatih',
            '14' => 'Ferhatpaşa',
            '15' => 'Gökçeali',
            '16' => 'Gümüşpınar',
            '17' => 'Hallaçlı',
            '18' => 'Hisarbeyli',
            '19' => 'İhsaniye',
            '20' => 'İnceğiz',
            '21' => 'İzzettin',
            '22' => 'Kabakça',
            '23' => 'Kaleiçi',
            '24' => 'Kalfa',
            '25' => 'Karacaköy',
            '26' => 'Karamandere',
            '27' => 'Kestanelik',
            '28' => 'Kızılcaali',
            '29' => 'Muratbey',
            '30' => 'Nakkaş',
            '31' => 'Oklalı',
            '32' => 'Ormanlı',
            '33' => 'Ovayenice',
            '34' => 'Örcünlü',
            '35' => 'Örencik',
            '36' => 'Subaşı',
            '37' => 'Yalıköy',
            '38' => 'Yaylacık',
            '39' => 'Yazlık',
        ];

        return $data;
    }
}
