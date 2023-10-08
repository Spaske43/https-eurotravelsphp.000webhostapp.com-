$( document ).ready(function() {

  // PRETRAGA
  $("#search-button").on("click", function (){
      let keyword = $("#search-term").val();
      $("#search-results").css("display","block");


      if(keyword.length < 3){
          $("#search-results-list").html
          ('<li class="list-group-item py-3 px-2">Unesite barem 3 slova za pretragu.</li>');
      }else{
          $.ajax({
              url: "models/offers/search.php",
              method: "GET",
              dataType: "JSON",
              data: {
                  keyword: keyword
              },
              success: function (res){
                  printResults(res)
              },
              error: function (err){
                  console.log(err)
              }
          })
      }
  })
});


// FUNKCIJE

function printResults(res){
  let html = "";

  if(res.length > 0){
      res.forEach(item => {
          html += `
          <li class="list-group-item search-result-item">
              <a class="text-dark" href="index.php?page=ponuda&&id=${item.id}">
                 ${item.offer_name} / ${item.country_name}
              </a>
          </li>
      `;
      })
  }else{
      html = '<li class="list-group-item py-3 px-2">Nema rezultata.</li>';
  }


  $("#search-results-list").html(html);
}