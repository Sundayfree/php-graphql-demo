<?php
namespace db;

class Db{

    static function init(){
        return [
            [
                "uId"=>1,
                "name"=>"liu",
                "gender"=>1,
                "address"=>[
                    "aId"=>01,
                    "city"=>"handan",
                    "country"=>"china"
                ]
            ],
            [
                "uId"=>2,
                "name"=>"liu1",
                "gender"=>0,
                "address"=>[
                    "aId"=>02,
                    "city"=>"handan",
                    "country"=>"china"
                ]

            ],
            [
                "uId"=>3,
                "name"=>"liu2",
                "gender"=>1,
                "address"=>[
                    "aId"=>03,
                    "city"=>"handa1n2",
                    "country"=>"china"
                ]

            ],

        ];
    }
}