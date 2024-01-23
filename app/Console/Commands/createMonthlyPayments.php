<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Console\Command;

class createMonthlyPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:monthly-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Create Monthly Payments');
        $month = Carbon::now()->format('F');
        $year = Carbon::now()->format('Y');
        $shops = Shop::all();
        foreach($shops as $shop)
        {
            $this->info('Create Monthly Payments : For Shop '.$shop->shop_name);
            if(Payment::where('month',$month)->where('shop_id',$shop->id)->where('year',$year)->count() == 0)
            {
                $this->info('Create Monthly Payments : Payment does not exist for this month.');
                $inputNumber = $shop->establishment_shop ? $shop->establishment_shop->shop_rent : $shop->shop_rent;

                // Remove commas
                $numberWithoutCommas = str_replace(",", "", $inputNumber);
                Payment::create([
                    'month' => $month,
                    'shop_id' => $shop->id,
                    'year' => $year,
                    'user_id' => $shop->user_id ?? null,
                    'type' => 'monthly',
                    'location' => $shop->lat_long,
                    'name' => $shop->owner_name,
                    'owner_name' => $shop->owner_name,
                    'shop_name' => $shop->shop_name,
                    'phone' => $shop->phone,
                    'email' => $shop->email,
                    'is_paid' => 0,
                    'establishment_shop_id' => $shop->establishment_shop ? $shop->establishment_shop->id : $shop->establishment_shop_id,
                    'establishment_id' => $shop->establishment_shop ? $shop->establishment_shop->establishment_id  : $shop->establishment_id,
                    'amount' => $numberWithoutCommas,
                    'shop_rent' => $shop->establishment_shop ? $shop->establishment_shop->shop_rent : $shop->shop_rent,
                    'shop_size' => $shop->establishment_shop ? $shop->establishment_shop->shop_size : $shop->shop_size,
                    'shop_type' => $shop->establishment_shop ? $shop->establishment_shop->shop_type : $shop->shop_type,
                    'shop_number' => $shop->establishment_shop ? $shop->establishment_shop->shop_number : $shop->shop_number,
                ]);
            }else{
                $this->info('Create Monthly Payments : Payment already exist for this month.');
            }
        }
        return Command::SUCCESS;
    }
}
