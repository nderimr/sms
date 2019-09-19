angular.module('stockService',[])
.factory('StockService', function($http,$log){
    return {
           /*
              parses exel data into array of JSON objects 
              param data 
             returns products
           */
          parseCopiedExcel: function(data) {
          var products = [];
          var col=0;
          var i=0;
          var j;
          
          while(i<data.length)
          {
          	  
                 j=i;
                 col=0;  
                 var productInfo =new Array(7); 
                 var productJson={};
                 for(k=0;k<7;k++)
                  productInfo[k]="";
                
                  while(data.charCodeAt(j)!=10 && j<data.length)
                  {
                  	   if(data.charCodeAt(j)==9 ) //new element or new line 
                       {
                          
                         switch(col){
                          case 0: 
                            productJson['number']=parseInt(productInfo[col].trim());
                            break;
                          case 1: 
                            productJson['description']=productInfo[col].trim();
                            break;
                          case 2: 
                            productJson['brand_name']=productInfo[col].trim();
                            break;
                          case 3: 
                            //productInfo[col] = productInfo[col].replace(/\s+/g, ''); //remove spaces
                            productJson['quantity']=parseInt(productInfo[col].trim());
                            break;
                          case 4: 
                            //productInfo[col] = productInfo[col].replace(/\s+/g, ''); //remove spaces
                            productJson['price']=parseFloat(productInfo[col].trim());
                            break;
                          case 5: 
                            productJson['condition']=productInfo[col].trim();
                            break;  
                         }
                           col++; 
                       }
                    productInfo[col]=productInfo[col]+data[j];
                    j++;      
                  } //end while(data.charCodeAt(j)!=10 && j<data.length) 
                if(col==6)
                    productJson['location']=productInfo[col].trim();
                    products.push(productJson);
                   i=j+1;
              
            }//end while i<data.lenght 
         
         return products;   

         },  //end parseCopiedExcel

      postAllProducts:function (products) {
     // var jsonProducts=JSON.stringify(products);
          var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                   
                }
               

            }
              return $http.post("api/parts",products,config);        
      },///end postAllProducts function 

       getProducts: function()
       {
            return $http.get("api/parts"); 

       },  //end getProducts
       
       
       updateProduct:function(product,id){
       var config = {
                headers : {
                    'Content-Type': 'application/json',
                   
                }
               

            }
          //console.log(product);
          return $http.put("api/part/"+id,product,config);
       }, //end update procuct 
       
       storeProduct: function(product){
          
          return $http.post("api/part")
       }

   }//end factory 


} ); 