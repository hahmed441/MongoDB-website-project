$(document).ready(function(){
	//alert("Hi");
	$.ajax(
    {
        type:"POST",
        url: "php/loadColumn.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#column").html(data);
        }
     });
	 
	$.ajax(
    {
        type:"POST",
        url: "php/reportedBy.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#reportedBy").html(data);
        }
     }); 
	
	$.ajax(
    {
        type:"POST",
        url: "php/fallsWithin.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#fallsWithin").html(data);
        }
     }); 
	 $.ajax(
    {
        type:"POST",
        url: "php/location.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#location").html(data);
        }
     });
	 $.ajax(
    {
        type:"POST",
        url: "php/LSOACode.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#LSOACode").html(data);
        }
     });
	 $.ajax(
    {
        type:"POST",
        url: "php/LSOAName.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#LSOAName").html(data);
			
        }
     });
	 $.ajax(
    {
        type:"POST",
        url: "php/crimeType.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#crimeType").html(data);
        }
     });
	 $.ajax(
    {
        type:"POST",
        url: "php/lastOutcome.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#lastOutcome").html(data);
        }
     });
	 $.ajax(
    {
        type:"POST",
        url: "php/columnOptions.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#columnOption").html(data);
			$("#columnOption2").html(data);
        }
     });
	 $.ajax(
    {
        type:"POST",
        url: "php/month.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#month").html(data);
        }
     });
	 
	
});
	
$("#showAllData").click(function() {
    //location.reload();
	//alert("Hi");
});

function resetAll()
{
	location.reload();	
};

function showAllData()
{
	$.ajax(
    {
        type:"POST",
        url: "php/showData.php",
        success: function( data ) 
        {
			//alert(data.quote);
            $("#displayData").html(data);
        }
     });	
};

function searchBtn()
{
	var favorite = [];
            $.each($("input[name='column']:checked"), function(){            
                favorite.push($(this).val());
            });
            //alert("Columns are: " + favorite.join(", "));

	//var val=[];
	//val = $('#lsoan').val(); 
	//alert(val);
	//alert($('#crimeType :selected').val());
			$.ajax(
				{
				type:"POST",
				url: "php/searchData.php",
				data: {
					checkedData: favorite,
					longitude: $('#longitude').val(),
					lattitude: $('#lattitude').val(),
					month: $('#month :selected').val(),
					reportedBy: $('#reportedBy :selected').val(),
					fallsWithin: $('#fallsWithin :selected').val(),
					location: $('#location :selected').val(),
					LSOACode: $('#LSOACode :selected').val(),
					LSOAName: $('#lsoan').val(),
					crimeType: $('#crimeType :selected').val(),
					lastOutcome: $('#lastOutcome :selected').val(),
					aggType: $('#aggType :selected').val(),
					columnOption: $('#columnOption :selected').val(),
					columnOption2: $('#columnOption2 :selected').val(),
					sortType: $('#sortType :selected').val(),
					limit: $('#limit').val()
					},
				success: function( data ) 
				{
					//alert(data.quote);
					$("#displayData").html(data);
				}
			});
			
}