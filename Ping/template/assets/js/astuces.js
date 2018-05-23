function ExportToTable() {  

   var reader = new FileReader();  
   reader.onload = function (e) {  
      var data = e.target.result;  
      
      /*Converts the excel data in to object*/  
      var workbook = XLSX.read(data, { type: 'binary' });  
      //var workbook = XLS.read(data, { type: 'binary' });  
      
      /*Gets all the sheetnames of excel in to a variable*/  
      var sheet_name_list = workbook.SheetNames;  

      var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/  
      sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/  
      /*Convert the cell value to Json*/  
      if (xlsxflag) {  
         var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);  
      }  
      else {  
         var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
      }  
      if (exceljson.length > 0 && cnt == 0) {  
         BindTable(exceljson, '#exceltable');  
         cnt++;  
      }  
   });  
   $('#exceltable').show();  
   }  
   if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/  
      reader.readAsArrayBuffer($("#excelfile")[0].files[0]);  
   }  
   else {  
      reader.readAsBinaryString($("#excelfile")[0].files[0]);  
   }  
}  
