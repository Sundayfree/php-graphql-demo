<?php

require_once './vendor/autoload.php';
require_once 'Db.php';
use db\Db;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;


 $address= new ObjectType([
     'name'=>'Address',
     'fields'=>[
         'aId'=>Type::int(),
         'city'=>Type::string(),
         'country'=>Type::string()
     ]
 ]);

 $user= new ObjectType([
     'name'=>'User',
     'fields'=>[
         'uId'=>Type::int(),
         'name'=>Type::string(),
         'gender'=>Type::boolean(),
         'address'=>$address
     ]
 ]);

 $rootType= new ObjectType([
     'name'=>'Root',
     'fields'=>[
         'user'=>[
             'type'=>$user,
             'args'=>[
                 'id'=>Type::int(),
             ],
             'resolve'=>function($root,$args){
                $data = Db::init();
                $returnData =[];
                foreach ($data as $user){
                   if( $user['uId']= $args['id'] ){
                       $returnData= $user;
                   }
                }
                return $returnData;
             }
         ],
         'userList'=>[
             'type' =>Type::listOf($user),
             'resolve'=>function($root,$args){
                 $data = Db::init();
                 return $data;
             }

         ]
     ]
 ]);

 $schema = new Schema([
     "query"=>$rootType
 ]);

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
$query = $input['query'];

$result= \GraphQL\GraphQL::executeQuery($schema,$query,);
$output = $result->toArray();
header('Content-Type: application/json');
echo json_encode($output);