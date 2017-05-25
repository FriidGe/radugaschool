$(document).ready(function () {
   $("#updateRasp").hide();
    $("#addProg").hide();
    $(".btn-group").hide();
    $(".selectClick").hide();
    $("#labelForSelect").hide();
   userUpdate();
   $(".selectClick").change(function () {
      userUpdate();
   });
   $("#updateRasp").click(function () {
      tableUpdate("","");
   });



   $("#addHomeWork").click(function () {
       var idUserClass = $(".selectClick1 option:selected").val();
       var name = $("#name").val();
       var date = $("#date").val();
       $.ajax({
           url: "/addHome",
           type: "POST",
           data: { userclass:idUserClass, name:name, date:date},
           response:'text',
           success: function(data){
               $.notify("Запись успешна добавлена", "success");
               $("#name").val("");
           }
       });
   });

    $("#addHomework").click(function () {
        $('#modalAddHomeWork').modal('show');
    });

    $("#findRasp").click(function () {
        $('#myFindRasp').modal('show');
    });
   
   $("#addProg").click(function () {
      $('#myModalAdd').modal('show');
   });

    $("#add").click(function () {
        var pupil = $(".userClick option:selected").val();
        var subject = $("#addProg").attr("data-id");
        var mark = $("#mark1").val();
        var date = $("#date1").val();
        var note = $("#note").val();

        $.ajax({
         url: "/tableAdd",
         type: "POST",
         data: {pupil:pupil, subject:subject, mark:mark,date:date,note:note},
         response:'text',
         success: function(data){
             if(data != "ok"){
                 $.notify("Отправлено сообщение родителям", "warn");
             }
             $.notify("Запись успешна добавлена", "success");
             tableUpdate("","");
             }
         });
    });

    $("#findR").click(function () {
            var pupil = $(".userClick option:selected").val();
            var subject = $("#addProg").attr("data-id");
            var date1 = $("#dateFirst").val();

        //lert(subject + " : " + date1 +" : " + pupil);
        $.ajax({
            url: "/findRasp",
            type: "POST",
            data: {pupil:pupil, subject:subject, date1:date1},
            response:'text',
            success: function(data){
                $('#updateTable').html(data);
            }
        });
    });
});

function userUpdate() {
   var text = ($(".selectClick option:selected").text()).split(' ');
   var school = $(".selectClick option:selected").val();
   var number = text[0];
   var letter = text[1];
   $.ajax({
      url: "/userUpdate",
      type: "POST",
      data: {number:number, letter:letter, school:school},
      response:'text',
      success: function(data){
         $('.updateUser').html(data);
         $("#updateRasp").fadeIn();
         $("#addProg").fadeIn();
          $(".btn-group").fadeIn();
          $(".selectClick").fadeIn();
          $("#labelForSelect").fadeIn();
      }
   });
}


function tableUpdate(mark,id) {
   var school = $(".selectClick option:selected").val();
   var pupil = $(".userClick option:selected").val();
   var subject = $("#updateRasp").val();
   $.ajax({
      url: "/tableUpdate",
      type: "POST",
      data: {subject:subject, pupil:pupil, school:school, mark:mark, id:id },
      response:'text',
      success: function(data){
         $('#updateTable').html(data);
      }
   });
}
