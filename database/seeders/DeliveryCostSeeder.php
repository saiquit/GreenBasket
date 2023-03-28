<?php

namespace Database\Seeders;

use App\Models\DeliveryCost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = array(
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Comilla', 'name_bn' => 'কুমিল্লা', 'lat' => '23.4682747', 'lon' => '91.1788135', 'url' => 'www.comilla.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Feni', 'name_bn' => 'ফেনী', 'lat' => '23.023231', 'lon' => '91.3840844', 'url' => 'www.feni.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Brahmanbaria', 'name_bn' => 'ব্রাহ্মণবাড়িয়া', 'lat' => '23.9570904', 'lon' => '91.1119286', 'url' => 'www.brahmanbaria.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Rangamati', 'name_bn' => 'রাঙ্গামাটি', 'lat' => '22.65561018', 'lon' => '92.17541121', 'url' => 'www.rangamati.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Noakhali', 'name_bn' => 'নোয়াখালী', 'lat' => '22.869563', 'lon' => '91.099398', 'url' => 'www.noakhali.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Chandpur', 'name_bn' => 'চাঁদপুর', 'lat' => '23.2332585', 'lon' => '90.6712912', 'url' => 'www.chandpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Lakshmipur', 'name_bn' => 'লক্ষ্মীপুর', 'lat' => '22.942477', 'lon' => '90.841184', 'url' => 'www.lakshmipur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Chattogram', 'name_bn' => 'চট্টগ্রাম', 'lat' => '22.335109', 'lon' => '91.834073', 'url' => 'www.chittagong.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Coxsbazar', 'name_bn' => 'কক্সবাজার', 'lat' => '21.44315751', 'lon' => '91.97381741', 'url' => 'www.coxsbazar.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Khagrachhari', 'name_bn' => 'খাগড়াছড়ি', 'lat' => '23.119285', 'lon' => '91.984663', 'url' => 'www.khagrachhari.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Bandarban', 'name_bn' => 'বান্দরবান', 'lat' => '22.1953275', 'lon' => '92.2183773', 'url' => 'www.bandarban.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Sirajganj', 'name_bn' => 'সিরাজগঞ্জ', 'lat' => '24.4533978', 'lon' => '89.7006815', 'url' => 'www.sirajganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Pabna', 'name_bn' => 'পাবনা', 'lat' => '23.998524', 'lon' => '89.233645', 'url' => 'www.pabna.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Bogura', 'name_bn' => 'বগুড়া', 'lat' => '24.8465228', 'lon' => '89.377755', 'url' => 'www.bogra.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Rajshahi', 'name_bn' => 'রাজশাহী', 'lat' => '24.37230298', 'lon' => '88.56307623', 'url' => 'www.rajshahi.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Natore', 'name_bn' => 'নাটোর', 'lat' => '24.420556', 'lon' => '89.000282', 'url' => 'www.natore.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Joypurhat', 'name_bn' => 'জয়পুরহাট', 'lat' => '25.09636876', 'lon' => '89.04004280', 'url' => 'www.joypurhat.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Chapainawabganj', 'name_bn' => 'চাঁপাইনবাবগঞ্জ', 'lat' => '24.5965034', 'lon' => '88.2775122', 'url' => 'www.chapainawabganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Naogaon', 'name_bn' => 'নওগাঁ', 'lat' => '24.83256191', 'lon' => '88.92485205', 'url' => 'www.naogaon.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Jashore', 'name_bn' => 'যশোর', 'lat' => '23.16643', 'lon' => '89.2081126', 'url' => 'www.jessore.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Satkhira', 'name_bn' => 'সাতক্ষীরা', 'lat' => '22.7180905', 'lon' => '89.0687033', 'url' => 'www.satkhira.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Meherpur', 'name_bn' => 'মেহেরপুর', 'lat' => '23.762213', 'lon' => '88.631821', 'url' => 'www.meherpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Narail', 'name_bn' => 'নড়াইল', 'lat' => '23.172534', 'lon' => '89.512672', 'url' => 'www.narail.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Chuadanga', 'name_bn' => 'চুয়াডাঙ্গা', 'lat' => '23.6401961', 'lon' => '88.841841', 'url' => 'www.chuadanga.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Kushtia', 'name_bn' => 'কুষ্টিয়া', 'lat' => '23.901258', 'lon' => '89.120482', 'url' => 'www.kushtia.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Magura', 'name_bn' => 'মাগুরা', 'lat' => '23.487337', 'lon' => '89.419956', 'url' => 'www.magura.gov.bd'),
            array('base_cost' => 50.00, 'increment_cost' => 0, 'name_en' => 'Khulna', 'name_bn' => 'খুলনা', 'lat' => '22.815774', 'lon' => '89.568679', 'url' => 'www.khulna.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Bagerhat', 'name_bn' => 'বাগেরহাট', 'lat' => '22.651568', 'lon' => '89.785938', 'url' => 'www.bagerhat.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Jhenaidah', 'name_bn' => 'ঝিনাইদহ', 'lat' => '23.5448176', 'lon' => '89.1539213', 'url' => 'www.jhenaidah.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Jhalakathi', 'name_bn' => 'ঝালকাঠি', 'lat' => '22.6422689', 'lon' => '90.2003932', 'url' => 'www.jhalakathi.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Patuakhali', 'name_bn' => 'পটুয়াখালী', 'lat' => '22.3596316', 'lon' => '90.3298712', 'url' => 'www.patuakhali.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Pirojpur', 'name_bn' => 'পিরোজপুর', 'lat' => '22.5781398', 'lon' => '89.9983909', 'url' => 'www.pirojpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Barisal', 'name_bn' => 'বরিশাল', 'lat' => '22.7004179', 'lon' => '90.3731568', 'url' => 'www.barisal.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Bhola', 'name_bn' => 'ভোলা', 'lat' => '22.685923', 'lon' => '90.648179', 'url' => 'www.bhola.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Barguna', 'name_bn' => 'বরগুনা', 'lat' => '22.159182', 'lon' => '90.125581', 'url' => 'www.barguna.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Sylhet', 'name_bn' => 'সিলেট', 'lat' => '24.8897956', 'lon' => '91.8697894', 'url' => 'www.sylhet.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Moulvibazar', 'name_bn' => 'মৌলভীবাজার', 'lat' => '24.482934', 'lon' => '91.777417', 'url' => 'www.moulvibazar.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Habiganj', 'name_bn' => 'হবিগঞ্জ', 'lat' => '24.374945', 'lon' => '91.41553', 'url' => 'www.habiganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Sunamganj', 'name_bn' => 'সুনামগঞ্জ', 'lat' => '25.0658042', 'lon' => '91.3950115', 'url' => 'www.sunamganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Narsingdi', 'name_bn' => 'নরসিংদী', 'lat' => '23.932233', 'lon' => '90.71541', 'url' => 'www.narsingdi.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Gazipur', 'name_bn' => 'গাজীপুর', 'lat' => '24.0022858', 'lon' => '90.4264283', 'url' => 'www.gazipur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Shariatpur', 'name_bn' => 'শরীয়তপুর', 'lat' => '23.2060195', 'lon' => '90.3477725', 'url' => 'www.shariatpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Narayanganj', 'name_bn' => 'নারায়ণগঞ্জ', 'lat' => '23.63366', 'lon' => '90.496482', 'url' => 'www.narayanganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Tangail', 'name_bn' => 'টাঙ্গাইল', 'lat' => '24.264145', 'lon' => '89.918029', 'url' => 'www.tangail.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Kishoreganj', 'name_bn' => 'কিশোরগঞ্জ', 'lat' => '24.444937', 'lon' => '90.776575', 'url' => 'www.kishoreganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Manikganj', 'name_bn' => 'মানিকগঞ্জ', 'lat' => '23.8602262', 'lon' => "90.0018293", 'url' => 'www.manikganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Dhaka', 'name_bn' => 'ঢাকা', 'lat' => '23.7115253', 'lon' => '90.4111451', 'url' => 'www.dhaka.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Munshiganj', 'name_bn' => 'মুন্সিগঞ্জ', 'lat' => '23.5435742', 'lon' => '90.5354327', 'url' => 'www.munshiganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Rajbari', 'name_bn' => 'রাজবাড়ী', 'lat' => '23.7574305', 'lon' => '89.6444665', 'url' => 'www.rajbari.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Madaripur', 'name_bn' => 'মাদারীপুর', 'lat' => '23.164102', 'lon' => '90.1896805', 'url' => 'www.madaripur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Gopalganj', 'name_bn' => 'গোপালগঞ্জ', 'lat' => '23.0050857', 'lon' => '89.8266059', 'url' => 'www.gopalganj.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Faridpur', 'name_bn' => 'ফরিদপুর', 'lat' => '23.6070822', 'lon' => '89.8429406', 'url' => 'www.faridpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Panchagarh', 'name_bn' => 'পঞ্চগড়', 'lat' => '26.3411', 'lon' => '88.5541606', 'url' => 'www.panchagarh.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Dinajpur', 'name_bn' => 'দিনাজপুর', 'lat' => '25.6217061', 'lon' => '88.6354504', 'url' => 'www.dinajpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Lalmonirhat', 'name_bn' => 'লালমনিরহাট', 'lat' => '25.9165451', 'lon' => '89.4532409', 'url' => 'www.lalmonirhat.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Nilphamari', 'name_bn' => 'নীলফামারী', 'lat' => '25.931794', 'lon' => '88.856006', 'url' => 'www.nilphamari.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Gaibandha', 'name_bn' => 'গাইবান্ধা', 'lat' => '25.328751', 'lon' => '89.528088', 'url' => 'www.gaibandha.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Thakurgaon', 'name_bn' => 'ঠাকুরগাঁও', 'lat' => '26.0336945', 'lon' => '88.4616834', 'url' => 'www.thakurgaon.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Rangpur', 'name_bn' => 'রংপুর', 'lat' => '25.7558096', 'lon' => '89.244462', 'url' => 'www.rangpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Kurigram', 'name_bn' => 'কুড়িগ্রাম', 'lat' => '25.805445', 'lon' => '89.636174', 'url' => 'www.kurigram.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Sherpur', 'name_bn' => 'শেরপুর', 'lat' => '25.0204933', 'lon' => '90.0152966', 'url' => 'www.sherpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Mymensingh', 'name_bn' => 'ময়মনসিংহ', 'lat' => '24.7465670', 'lon' => '90.4072093', 'url' => 'www.mymensingh.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Jamalpur', 'name_bn' => 'জামালপুর', 'lat' => '24.937533', 'lon' => '89.937775', 'url' => 'www.jamalpur.gov.bd'),
            array('base_cost' => 120.00, 'increment_cost' => 10.0, 'name_en' => 'Netrokona', 'name_bn' => 'নেত্রকোণা', 'lat' => '24.870955', 'lon' => '90.727887', 'url' => 'www.netrokona.gov.bd')
        );
        foreach ($districts as $key => $district) {
            // dump($district);
            DeliveryCost::create(['name_en' => $district['name_en'], 'name_bn' => $district['name_bn'], 'base_cost' => $district['base_cost'], 'increment_cost' => $district['increment_cost']]);
        }
    }
}
