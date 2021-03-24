<?php
/**
 * Country Seeder
 */

use Illuminate\Database\Seeder;

/**
 * This class is a seeder for country model.
 */
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach( config( 'country' ) as $item ){
            DB::table( 'country' )->insert( [
                                                'country_name' => $item['name'],
                                                'country_code' => $item['code'],
                                            ] );
        }

    }
}
