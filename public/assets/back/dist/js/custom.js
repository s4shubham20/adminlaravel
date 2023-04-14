$(document).ready(function () {
    $('#categoryId').on('change', function () {
        var idCat = this.value;
        var token = $('meta[name="csrf-token"]').attr('content');
        $("#subcategoryId").html('');
        $.ajax({
            url: "/subcategories",
            type: "post",
            data:{catId:idCat, _token : token},
            success: function (res) {
                $("#subcategoryId").html(res);
            }
        });
    });
});

function DeleteConfirmation()
{
    var result = confirm("Are you sure want to delete this?");
    if(result == true){
        return true;
    }else{
        return false;
    }
}

$(document).ready(function () {
    $('#brandcategoryId').on('change', function () {
        var brandidCat = this.value;
        var token = $('meta[name="csrf-token"]').attr('content');
        var brandId =$("#ubrandId").val();
        //alert(brandidCat);

        $("#brandsubcategoryId").html('');
        $.ajax({
            url: "/brandsubcategories",
            type: "post",
            data:{cat_Id:brandidCat,brand_Id:brandId, _token : token},
            success: function (response) {
                $("#brandsubcategoryId").html(response);
                console(response);
            }
        });
    });
});
