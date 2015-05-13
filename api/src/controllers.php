<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;



$app->get('/clientes', function(){
    $cotizaciones = R::findAll('clientes');
    
    $res = array();
    foreach ($cotizaciones as $c) {
        $r = array(
               'id'=>$c->id,
               'nombre'=>$c->nombre,
               'email'=>$c->email,
               'direccion'=>$c->direccion
            );
        $res[] = $r;
    }

    return new Response(json_encode($res), 200); 
});

$app->post('/clientes', function(Request $request){
    
    $c = R::dispense('clientes');
    $c->nombre = $request->request->get('nombre');
    $c->email = $request->request->get('email');
    $c->direccion = $request->request->get('direccion');
    $id = R::store($c);
    $r = array(
            'id'=>$c->id,
            'nombre'=>$c->nombre,
            'email'=>$c->email,
            'direccion'=>$c->direccion
        );
    return new Response(json_encode(array($r)), 201);
    
});

return $app;