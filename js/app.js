//declarar el modulo
var app = angular.module('app',[]);
//definimos el controlador
app.controller('MainCtrl',function($scope,$http) {
	$scope.appname = 'Gestor de Clientes';
	$scope.clientes = [];

	var cargar = function(){
		$http.get('api/clientes')
		.success(function(data){
			$scope.clientes = data;
		})
		.error(function(){
			console.log('Error de datos');
		});
	};

	cargar();

	$scope.guardar = function(datos){
		$http.post('api/clientes',datos)
		.success(function(data){
			cargar();
			$scope.clienteForm = {};
		})
		.error();
	};

});