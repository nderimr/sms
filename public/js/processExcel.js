 $(document).ready(function() {
                  var makeElementEditable = function(element) {
                  $('div', element).attr('contenteditable', true);
                  $(element).focusout(function() {
                    $('div', element).attr('contenteditable', false);
                  });
                  $(element).keydown(function(e) {
                    if (e.which == 13) {
                      e.preventDefault();
                      $('div', element).attr('contenteditable', false);
                      $(document).focus();
                    }
                  });
                  $('div', element).on('paste', function(e) {
                    e.preventDefault();
                  });
                };
              
                $(document).on('keypress', 'textarea#excelPasteBox', function(e) {
                  if (e.ctrlKey !== true && e.key != 'v') {
                    e.preventDefault();
                    e.stopPropagation();
                  }
                });
                $(document).on('paste', 'textarea#excelPasteBox', function(e) {
                   $('#submitParagraph').show();
                  e.preventDefault();
                  var cb;
                  var clipText = '';
                  if (window.clipboardData && window.clipboardData.getData) {
                    cb = window.clipboardData;
                    clipText = cb.getData('Text');
                  } else if (e.clipboardData && e.clipboardData.getData) {
                    cb = e.clipboardData;
                    clipText = cb.getData('text/plain');
                  } else {
                    cb = e.originalEvent.clipboardData;
                    clipText = cb.getData('text/plain');
                  }
                  var clipRows = clipText.split('\n');
                   
				  for (i = 0; i < clipRows.length; i++) {
                    clipRows[i] = clipRows[i].split('\t');
                  }
				  var htmlTable='<table class="table table-bordered table-striped">';
                  htmlTable+="<tr> <th>Number</th> <th>Description</th><th>brand</th> <th>qty</th><th>price</th><th>condition</th><th>location</th></tr>";
                  for (i = 0; i < clipRows.length - 1; i++) {
                    htmlTable+='<tr>';
                    for (j = 0; j < clipRows[i].length; j++) {
                      if (clipRows[i][j] != '\r') {
                        if (clipRows[i][j].length !== 0) {
                          htmlTable+='<td contenteditable="true">'+clipRows[i][j]+'</td>'
					                }
                      }
                    }
					         htmlTable+='</tr>';
                   }
				  htmlTable+='</table>';
          //  htmlTable table element is set as nested html content of the div with ID prductTable  
          $("#productTable").html(htmlTable); 
          

         
                  
       });
                
                
  });