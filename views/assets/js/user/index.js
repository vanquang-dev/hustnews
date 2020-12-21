
fetch('api/post/read_news.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        var posts = document.getElementById('posts');
        for (a of data.result) {
            posts.insertAdjacentHTML('beforeend', "<div class='news-card'><a href=" + a.link_post + "><div class='card-blur' style='background: url(" + a.image + ") center center / cover'></div><div class='card-img' style='background: url(" + a.image + ") center center / cover'></div></a><p class='card-category'>" + a.category + "</p><a href=" + a.link_post + "><div class='card-title'>" + a.title + "</div></a><div class='card-description'>" + a.description + "</div><div class='card-author'><div class='card-author-user'><div class='card-avatar-author' style='background: url(" + a.avatar + ") center center / cover'></div>" + a.username + "</div><div class='card-time'>" + a.created + "</div></div></div>");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });

fetch('api/post/popular.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        var popular = document.getElementById('popular');
        popular.insertAdjacentHTML('beforeend', "<thead><tr id='title'><th>Tên bài viết</th><th id='like'> Lượt thích</th></tr></thead>");
        for (a of data.result) {
            popular.insertAdjacentHTML('beforeend', "<tbody><tr><td class='title'><a href=" + a.link_post + ">" + a.title + "</a></td><td class='like'>" + a.total_like + " <img class='heart' src='https://twemoji.maxcdn.com/2/72x72/2764.png' width='20'></td></tr></tbody>");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
document.getElementById('home').classList.add('active');