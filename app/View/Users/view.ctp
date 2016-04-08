<!DOCTYPE html>
<html >
	<head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			input {
				margin: 6px;
			}

			table, th , td  {
			  border: 1px solid grey;
			  border-collapse: collapse;
			  padding: 5px;
			}

			table tr:nth-child(odd) {
			  background-color: #f1f1f1;
			}

			table tr:nth-child(even) {
			  background-color: #ffffff;
			}

			.todoRows td:hover {
				cursor: pointer;
			}
		</style>
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	</head>
	<body>
		<div ng-app="myApp" class="container" ng-controller="customersCtrl" ng-init="country = ''; rangeAmount = '';">
                                <div class="jumbotron gumbo">
                                                <h2>Mini To Do App</h2>
                                </div>
                                <br>
                                <form ng-submit="addTodo()" role="form">
                                                <h4><b>Enter To Do:</b></h4>
                                                <div class="form-group">
                                                                <label for="name">Name:</label><input type="text" id="name" class="form-control" ng-model="name">
                                                                <label for="description">Description:</label><textarea id="description" class="form-control" style="position:relative; left: .5%;" ng-model="description" rows="1"></textarea><br>
                                                                <input  class="btn-default" type="submit" value="Add">
                                                </div>
                                </form><br><br>
                                
 
                                <p>Search: <input type="text" ng-model="item"> Show: 
                                <select ng-model="rangeAmount">
                                   <option value=""></option>
                                   <option value="1">1</option>
                                   <option value="3">3</option>
                                   <option value="5">5</option>        
                                </select></p>
                                
                                <h4><b>To Do List:</b></h4>
                                <table class="table firstTable">
                                                <tr>
                                                                <th>Name</th>
                                                                <th>Description</th>
                                                                <th>Date</th>
                                                                <th>Complete?</th>
                                                                <th hidden></th>
                                                </tr>
                                                <tr title="Click to Edit" class="todoRows" ng-repeat="x in todos | filter:item | limitTo: rangeAmount track by $index" >
                                                                <td hidden>{{ x.id }}</td>
                                                                <td class="form-group">
                                                                                <input class="editName form-control input-sm" type="hidden" value="{{ x.name }}">
                                                                                <span class="hideName">{{ x.name }}</span>
                                                                </td>
                                                                <td class="form-group">
                                                                                <input class="editDescription form-control input-sm" ng-model="editDescription" type="hidden" value="{{x.description}}">
                                                                                <span class="hideDescription">{{ x.description }}</span>
                                                                </td>
                                                                <td class="form-group">
                                                                                <input class="editDate form-control input-sm" ng-model="editDate" type="hidden" value="{{ x.date }}">
                                                                                <span class="hideDate">{{ x.date }}</span>
                                                                </td>
                                                                <td class="form-group">
                                                                                <input class="form-control" type="checkbox" ng-click="addDoneRow(x)">
                                                                </td>
                                                                <td class="noBorder"><input type="submit" class="editButton btn-default" ng-click="editTodos(x)" value="Edit"></td>
                                                                <td class="noBorder"><input type="hidden" class="saveButton btn-default" ng-click="saveTodos(x)" value="Save"></td>
                                  </tr>
                                </table>
                                <button class="btn-default" ng-click="clearToDos()">Clear All To Dos</button><br>
                                <br>
                                <h4><b>Done:</b></h4>
                                <table class="table">
                                                <tr>
                                                                <th>Name</th>
                                                                <th>Description</th>
                                                                <th>Date</th>
                                                                <th>Complete?</th>
                                                </tr>
                                  <tr ng-repeat="y in finishedList | filter:item  | limitTo: rangeAmount track by $index">
                                                                <td>
                                                                                {{ y.name }}
                                                                </td>
                                                                <td>
                                                                                {{ y.description }}
                                                                </td>
                                                                <td>
                                                                                {{ y.date }}
                                                                </td>
                                                                <td>
                                                                                <input type="checkbox" checked="true" disabled>
                                                                </td>
                                  </tr>
                                </table>
                                <button class="btn-default" ng-click="clearDones()">Clear All Completed</button><br>
                </div>
                <script>
                
                                var app = angular.module('myApp', []);
                                app.controller('customersCtrl', function($scope) {
                                                $scope.todos = [];
                                                $scope.finishedList = [];
 
                                   //Used to clear the todo list
                                   //localStorage.removeItem('finishedList');
                                   //localStorage.removeItem('toDoItems');
                                
                                   
                                   if(JSON.parse(localStorage.getItem('toDoItems')))
                                   {
                                                                $scope.todos = JSON.parse(localStorage.getItem('toDoItems'));
                                   }
                                
                                   if(JSON.parse(localStorage.getItem('finishedList')))
                                   {   
                                                                $scope.finishedList = JSON.parse(localStorage.getItem('finishedList'));
                                   }
                                                  
                                   $scope.today = new Date();
                                   $scope.id = localStorage.getItem('toDoItemID');
                                   
                                   
                                   $scope.addTodo = function(){
                                                                                                
                                                                if($scope.name && $scope.description){
                                                                                $scope.todos.push({"id": ++$scope.id, "name": $scope.name, "description":$scope.description, "date":$scope.today.getMonth()+1+'/'+$scope.today.getDate()+'/'+$scope.today.getFullYear()});
                                                                                $scope.name = "";
                                                                                $scope.description = "";
                                                                                
                                                                                localStorage.removeItem('toDoItems');
                                                                                localStorage.setItem('toDoItems', JSON.stringify($scope.todos));
                                                                                localStorage.setItem('toDoItemID', $scope.id);
                                                                                                                                
                                                                }else{
                                                                                alert("Must enter both a To Do Name and Description.");
                                                                }
                                   }
                                   
                                   $scope.addDoneRow = function(data) {
                                                                /*data.name = document.getElementById("editName").value;
                                                                data.description = document.getElementById("editDescription").value;*/
                                                                data.date = $scope.today.getMonth()+1+'/'+$scope.today.getDate()+'/'+$scope.today.getFullYear();
 
 
                                                                $scope.finishedList.push(data);
                                                                $scope.todos.splice($scope.todos.indexOf(data.id),1);
                                                                
                                                                localStorage.removeItem('finishedList');
                                                                localStorage.removeItem('toDoItems');
                                                                
                                                                localStorage.setItem('finishedList', JSON.stringify($scope.finishedList));
                                                                localStorage.setItem('toDoItems', JSON.stringify($scope.todos));
                                                                localStorage.setItem('toDoItemID', --$scope.id);
                                                
                                   }              
                                   
                                   $scope.clearToDos = function() {
                                                   localStorage.removeItem('toDoItems');
                                                   localStorage.setItem('toDoItemID', 0);
                                                   $scope.id = 0;
                                                   $scope.todos = [];
                                   }
                                
                                   $scope.clearDones = function() {
                                                                localStorage.removeItem('finishedList');
                                                    $scope.finishedList = [];
                                   }
                                   
                                   $scope.editTodos = function(data) {
                                                                document.getElementsByClassName("hideName")[data.id - 1].style.visibility = "hidden";
                                                                document.getElementsByClassName("editName")[data.id - 1].type = "text";
                                                                document.getElementsByClassName("hideDescription")[data.id - 1].style.visibility = "hidden";
                                                                document.getElementsByClassName("editDescription")[data.id - 1].type = "text";
                                                                document.getElementsByClassName("hideDate")[data.id - 1].style.visibility = "hidden";
                                                                document.getElementsByClassName("editDate")[data.id - 1].type = "date";
                                                                document.getElementsByClassName("saveButton")[data.id - 1].type = "submit";
                                                                document.getElementsByClassName("editButton")[data.id - 1].type = "hidden";
                                   }
                                   
                                   $scope.saveTodos = function(data) {
 
                                                                $scope.todos[data.id - 1].name = document.getElementsByClassName("editName")[data.id - 1].value;
                                                                $scope.todos[data.id - 1].description = document.getElementsByClassName("editDescription")[data.id - 1].value;
                                                                $scope.todos[data.id - 1].date = document.getElementsByClassName("editDate")[data.id - 1].value;
                                                                localStorage.setItem('toDoItems', JSON.stringify($scope.todos));
                                                                
                                                                //angular refresh
                                                                document.getElementsByClassName("hideName")[data.id - 1].style.visibility = "visible";
                                                                document.getElementsByClassName("editName")[data.id - 1].type = "hidden";
                                                                document.getElementsByClassName("hideDescription")[data.id - 1].style.visibility = "visible";
                                                                document.getElementsByClassName("editDescription")[data.id - 1].type = "hidden";
                                                                document.getElementsByClassName("hideDate")[data.id - 1].style.visibility = "visible";
                                                                document.getElementsByClassName("editDate")[data.id - 1].type = "hidden";
                                                                document.getElementsByClassName("saveButton")[data.id - 1].type = "hidden";
                                                                document.getElementsByClassName("editButton")[data.id - 1].type = "submit";
                                                                
                                   }
                                });
                </script>
				                <style>
                                input {
                                                margin: 6px;
                                }
                                
                                body {
                                                
                                                background: linear-gradient( white, #E0FFFF);
                                                background-repeat: no-repeat;
                                background-attachment: fixed;
                                }
                                
                                table, th , td  {
                                   border: 1px solid #E0FFFF;
                                   border-collapse: collapse;
                                   padding: 5px;
                                }
                                
                                .firstTable td:nth-last-child(1) {
                                                
                                                background-color: #E0FFFF;
                                                
                                }
 
                                .firstTable td:nth-last-child(2) {
                                                
                                                background-color: #E0FFFF;                        
                                                
                                }
 
                                .firstTable th:nth-last-child(1) {
                                                
                                                background-color: #E0FFFF;                        
                                                
                                }
 
                                                                                                                                
                                table tr:nth-child(odd) {
                                  background-color: #f1f1f1;
                                }
                                
                                table tr:nth-child(even) {
                                  background-color: #ffffff;
                                }
                                
                                th {
                                                background-color: #3BB9FF;
                                                font-weight: 900;
                                }
                                
                                .todoRows td:hover {
                                                cursor: pointer;
                                }
                                
                                .noBorder {
                                                border: 0px; border-collapse: collapse;
                                }
                                
                                .btn-default {
                                                background: #FF7F3B !important;
                                }
                                .gumbo{
                                                font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif;
                                                margin: auto; 
                                                width: 100%; 
                                                padding: 10px; 
                                                color: #FF7F3B;
                                                text-align:center; 
                                                background: linear-gradient(#3BB9FF, white);
                                }
                </style>
	</body>
</html>

