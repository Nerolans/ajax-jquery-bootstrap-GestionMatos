$(document).ready(function(){
    $("#buttonADD").click(function(){
        var $form = $("#formADD");
        var $inputs = $form.find("input, select, textarea");
        var serializedData = $form.serialize();

        $inputs.prop("disabled", true);

        $.ajax({
            url: "checkEquipment.php",
            type: "POST",
            data: serializedData,

            success:function (response){

                if (response.indexOf("Success") >= 0)
                {
                    $("#getChangeSuccess").text("L'équipement a bien été ajouté"); 

                    window.setTimeout(function(){
                        $('#formADD')[0].reset();
                        $inputs.prop("disabled", false);
                        $(function () {
                            $('#myModal').modal('toggle');
                        });
                        $("#getChangeSuccess").text("");
                        $('#tableMain').append(response.split("-")[1]);
                    }, 1500);
                }
                else
                {
                    $inputs.prop("disabled", false);
                    $("#getChangeError").text(response);
                }

            },

            error:function (resultat, statut, erreur){

                console.log(resultat, statut, erreur );
            }
            
        });
    });

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CHECKED

    $("#buttonADD2").click(function(){
        var $form = $("#formADD2");
        var $inputs = $form.find("input");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);

        $.ajax({
            url: "checkType.php",
            type: "POST",
            data: serializedData,

            success:function (response){

                if(response == "Success")
                {
                    $("#getChangeError2").text("");
                    $("#getChangeSuccess2").text("Le type à bien été ajouté à la liste"); 

                    window.setTimeout(function(){
                        $('#formADD')[0].reset();
                        $inputs.prop("disabled", false);
                        $(function () {
                            $('#myModal2').modal('toggle');
                        });
                        $("#getChangeSuccess2").text("");
                    }, 1150);

                    $("#formADD").reload();
                }
                else
                {
                    $inputs.prop("disabled", false);
                    $("#getChangeError2").text(response);
                }

            },

            error:function (resultat, statut, erreur){

                console.log(resultat, statut, erreur );
            }
            
        });
    });
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tableMain tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
}); 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function typeClick(name)
{
    alert(name); //to finish here
};

function fillModal()
{
    $(document).ready(function(){
        $.ajax({
            url: "getInfos.php",
            type: "POST",
            data: serializedData,

            success:function(response){
                $('#myModalEdit').modal('show'); 

            },

            error:function (resultat, statut, erreur){

                console.log(resultat, statut, erreur );
            }
            
        });
    });
};



