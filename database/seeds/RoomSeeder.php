<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'room_number' => 'PHÒNG SUITE HƯỚNG BIỂN',
                'acreage'=>'40.2m2',
                'description'  =>'Decorated with soft tones combined with decorative crafts imbued with the Champa culture of the locality, the room is clearly divided. Down below is the living area with an L-shaped sofa and above is the bed, creating an elegant yet familiar feel at home. Silk cushions and extravagant bedspreads and pillows enhance the elegance and charm in the personality of this beautiful room itself.' ,
                'price' => 500000,
                'image' => '',
            ],
            [
                'room_number' => 'PHÒNG SUPERIOR HƯỚNG VƯỜN',
                'acreage'=>'40.2m2',
                'description'  => 'Decorated with soft tones combined with decorative crafts imbued with the Champa culture of the locality, the room is clearly divided. Down below is the living area with an L-shaped sofa and above is the bed, creating an elegant yet familiar feel at home. Silk cushions and extravagant bedspreads and pillows enhance the elegance and charm in the personality of this beautiful room itself.',
                'price' => 1000000,
                'image' => '',
            ],
            [
                'room_number' => 'PHÒNG DELUXE HƯỚNG VƯỜN',
                'acreage'=>'40.2m2',
                'description'  => 'Decorated with soft tones combined with decorative crafts imbued with the Champa culture of the locality, the room is clearly divided. Down below is the living area with an L-shaped sofa and above is the bed, creating an elegant yet familiar feel at home. Silk cushions and extravagant bedspreads and pillows enhance the elegance and charm in the personality of this beautiful room itself.',
                'price' => 5000000,
                'image' => '',
            ],
            [
                'room_number' => 'PHÒNG PRESIDENTIAL SUITE',
                'acreage'=>'40.2m2',
                'description'  => 'Decorated with soft tones combined with decorative crafts imbued with the Champa culture of the locality, the room is clearly divided. Down below is the living area with an L-shaped sofa and above is the bed, creating an elegant yet familiar feel at home. Silk cushions and extravagant bedspreads and pillows enhance the elegance and charm in the personality of this beautiful room itself.',
                'price' => 1000000,
                'image' => '',
            ],
            [
                'room_number' => 'PHÒNG SUITE HƯỚNG BIỂN',
                'acreage'=>'40.2m2',
                'description'  => 'Decorated with soft tones combined with decorative crafts imbued with the Champa culture of the locality, the room is clearly divided. Down below is the living area with an L-shaped sofa and above is the bed, creating an elegant yet familiar feel at home. Silk cushions and extravagant bedspreads and pillows enhance the elegance and charm in the personality of this beautiful room itself.',
                'price' => 1000000,
                'image' => '',
            ],
            [
                'room_number' => 'BIỆT THỰ HƯỚNG VƯỜN CÓ HỒ BƠI RIÊNG',
                'acreage'=>'40.2m2',
                'description'  =>'Decorated with soft tones combined with decorative crafts imbued with the Champa culture of the locality, the room is clearly divided. Down below is the living area with an L-shaped sofa and above is the bed, creating an elegant yet familiar feel at home. Silk cushions and extravagant bedspreads and pillows enhance the elegance and charm in the personality of this beautiful room itself.',
                'price' => 1000000,
                'image' => '',
            ]
        ];

        DB::table('rooms')->insert($data);
    }
}
