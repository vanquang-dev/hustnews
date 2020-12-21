
 var dom = document.getElementsByClassName('hihi');
 for (a of dom) {
     get_link(a);
 }

 function get_link(a) {
     a.addEventListener('click', () => {
         add_post(a.getAttribute('data-link'));
         a.classList.add('success');
         return false;
     })
 }

 function add_post(link) {
     data = { url: link };
     // add post user
     fetch('../api/post/add.php', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/json',
             },
             body: JSON.stringify(data),
         })
         .then(response => response.json())
         .then(data => {
             console.log('done');
             get_list_post();
             if (check == 'true') {
                 get_list_post();
             } else if (check == 'flase') {
                 get_list_hust();
             }
         })
         .catch((error) => {
             console.error('Error:', error);
         });
 }

 $(document).ready(function() {
    var dataTable = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "../api/post/read.php",
            type: "post"
        }
    });
 });

 document.getElementById('post-sidebar').classList.add('active');