<?php


use Phinx\Seed\AbstractSeed;

class AdditionalServicesDictionarySeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'label' => 'Получить наличные',
            ],
            [
                'label' => 'Погрузка посылки',
            ],
            [
                'label' => 'Отправить почтой',
            ],
            [
                'label' => 'Ожидание 20 мин',
            ]
        ];

        $user = $this->table('additional_services_dictionary');
        $user->insert($data)->save();
    }
}
