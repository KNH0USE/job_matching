<?php
namespace App\Services\Corporation;

use App\Services\Common\BaseService;
use App\Models\Corporation;
use App\Services\Resource\IndustriesService;

class CorporationsService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new Corporation);
    }

    public function findBy($data = [], $options = []) {

        return $entity->get();
    }

    public function convertData($data){
        if(!empty($data['establishment_date'])){

            $replace = str_replace('月', '-', $data['establishment_date']);
            $data['establishment_date'] = str_replace('年', '-', $replace).'-01';
        }

        if(!empty($data['capital'])){
            $data['capital'] = (int)$data['capital'];
        }

        if(!empty($data['amount_sales'])){
             $data['amount_sales'] = (int)$data['amount_sales'];
        }

        if(!empty($data['employees_number'])){
            $data['employees_number'] = (int)$data['employees_number'];
        }
        // dd($data);
        return $data;
    }
    public function getIndustryOptions() {
            try {
                $industry = new IndustriesService();
                $industries = $industry->findBy([])
                ->pluck('name', 'id')->toArray();
                array_unshift($industries, '選択してください');
            } catch (\Exception $e) {
                \Log::error($e);
                return false;
            }
            return $industries;
        }
    }
