angular.module('mainController',[])
.controller('StockController', function($scope,StockService,Popeye,$mdDialog){
$scope.products=[];
$scope.pastedProducts=[];
$scope.links;
$scope.meta;
$scope.currentPage = 1;
$scope.pageSize = 10;
$scope.productId;
 //IMPORTANT create another two separeted controllers one for Excel-view and other for Products-view  
 $scope.saveButtonVisible=false;
    //call the create html table with product data from pasted Excel products   
    //function must be renamed to pasteExcel data 
    //fields to be modified dinamically from the user or the first row names the row is the name of the data on the following rows     
     $scope.paste = function() {
               $scope.saveButtonVisible=true;
               $scope.pastedProducts=StockService.parseCopiedExcel($scope.x);
               $scope.x="";
      };

       //post array of products in JSON format to be saved in the database 

          $scope.postProducts = function() {
          StockService.postAllProducts($scope.pastedProducts)
          .then(function(response){
            $scope.pastedProducts.length=0;
          //load all products after inserting the new product
            //alert(response.data.message);
         })
      };
      
      //removes the product from the array with number  

       $scope.removecurrentProduct= function(number,source){
        //event.preventDefault(); 
             if(source=='p'){
                let index = $scope.products.findIndex( product => product.number === number);
                 $scope.products.splice(index,1);
                //call the laravel API to delete the product 
              }
              else {
                $scope.pastedProducts.splice(number, 1);
              }
        // return false;
      };  //end removecurrentProduct

        
               //edit current product  
        // copied from https://pathgather.github.io/popeye/ not working 
       $scope.editcurrentProduct= function(id,source){
        //event.preventDefault(); 
            // Open a modal to show the selected product  profile
                     var modal = Popeye.openModal({
                      templateUrl: "/sms/public/js/templates/editProduct.html",
                      controller: "StockController as ctrl",
                      resolve: {
                          user: function($http) {
                          return $http.get("api/part/"+id);
                          }
                      } 
                      
             
      });  //end editcurrentProduct   
   };

    
    
      $scope.getProducts=function(){
            StockService.getProducts()
             .then(function(response){
               $scope.products=response.data.data;
               $scope.links=response.data.links;
               $scope.meta=response.data.meta;
             })
      };//end getProducts
     $scope.getProducts();
        
      
      $scope.updateProduct=function(){
          
          // console.log($scope.products[$scope.editProductIndex],$scope.products[$scope.editProductIndex].id); 
           StockService.updateProduct($scope.products[$scope.editProductIndex],$scope.products[$scope.editProductIndex].id)
           .then(function(response){
          
           })

      }
       
     $scope.showDeleteModal=false;
     $scope.showModal = false;
     
      
     


      $scope.deleteProductId=0; 
      //display modal dialog for delete product confirmation function 
      $scope.showDeleteProductModal=function(id){
        $scope.deleteProductId=id;
        $scope.showDeleteModal = !$scope.showDeleteModal;
      } //end showDeleteProductModal

    
        //remove product from database 
        $scope.deleteProduct = function() {
          StockService.deleteProduct($scope.deleteProductId)
          .then(function(response){
                 let index = $scope.products.findIndex( product => product.id === $scope.deleteProductId);
                 $scope.products.splice(index,1);
                 $scope.toggleDeleteModal(); //hide modal
                 //alert("Product is deleted succesfully!"); //inform user product is deleted
         })
      };  //end deleteProduct

       //togle delete modal
      $scope.toggleDeleteModal= function() {
            $scope.showDeleteModal = !$scope.showDeleteModal;
      } 


      //get the product by number for edit 
      $scope.editProductIndex=0;
       $scope.editProduct=function(number){
        if($scope.showModal==false){
           let index = $scope.products.findIndex( product => product.number === number); 
            $scope.editProductIndex=index; 
        }//end if    
        $scope.showModal = !$scope.showModal;
      } //end editproduct

     //edit product modal sourrce: tutorialspoint.com
    
     $scope.toggleModal = function(){
        $scope.showModal = !$scope.showModal;
    }; //endedit product modal tutorials point
    
    
     
});