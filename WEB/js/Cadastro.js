$(function(){
   $.get('../Controlador/areas.php' ,{},function(retorno)
   {
       for(idx in retorno)
       {
        retorno[idx];
        $('<option value" ='+retorno[idx].id+'">'+retorno[idx].nome+'</option>')
                .appendTo('#select-area');
       }
   }, 'json');

});


