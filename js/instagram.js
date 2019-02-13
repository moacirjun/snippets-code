/* AJAX INTAGRAM */
var access_token = "7552841547.1677ed0.7ed406d7246d4dd09d594134b902e5b8";
var postsLinks = [];
var instagramPosts = {
    container : document.getElementById("instagram-posts"),
    post1 : {
        container : document.querySelector("#instagram-posts .post[data-id='1']"),
        status : "loading",
    },
    post2 : {
        container : document.querySelector("#instagram-posts .post[data-id='2']"),
        status : "loading",
    },
    post3 : {
        container : document.querySelector("#instagram-posts .post[data-id='3']"),
        status : "loading",
    },
    getNextPost : () => {
        if (instagramPosts.post1.status === "loading") return instagramPosts.post1;
        else if (instagramPosts.post2.status === "loading") return instagramPosts.post2;
        else if (instagramPosts.post3.status === "loading") return instagramPosts.post3;
    },
    todosCarregados : () => {
        return instagramPosts.post1.status === "loaded" && 
            instagramPosts.post2.status === "loaded" && 
            instagramPosts.post3.status === "loaded";
    }
};

function gerarLinksPostsInstagram() {
	var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
			JsonResponse = JSON.parse(this.responseText);
			
			if ("data" in JsonResponse) {
				var posts = JsonResponse.data;
				
				posts.forEach( post => {
					postsLinks.push(post.link);
				});
				
				gerarEmbedsInsgram(postsLinks);
			}
        }
    };

    xhttp.open("GET", getInstagramApiUrl(), true);
    xhttp.send();
}
gerarLinksPostsInstagram();

function getInstagramApiUrl() {
	return "https://api.instagram.com/v1/users/self/media/recent/?access_token=" + access_token + "&count=3";
}

function gerarEmbedsInsgram(posts_links) {
	posts_links.forEach( link => {
		ajaxEmbedApiIstagram(link);
	});
}

function ajaxEmbedApiIstagram(postLink) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            printarEmbedOnContainer(this.responseText);
        }
    };

    xhttp.open("GET", getEmbedApiUrl(postLink), true);
    xhttp.send();
}

function getEmbedApiUrl(postLink) {
    return "https://api.instagram.com/oembed?url=" +
            postLink +
            "&omitscript=true&maxwidth=320&hidecaption=true";
}

function printarEmbedOnContainer(response) {
    var jsonObject = JSON.parse(response);

    if ("html" in jsonObject) {
        var post = instagramPosts.getNextPost();

        post.container.innerHTML = jsonObject.html;
		post.status = "loaded";
		
        if (typeof instgrm !== "undefined" && instagramPosts.todosCarregados()) {
            instgrm.Embeds.process();
        }
    }
    else {
		console.log("Erro:");
        console.log(jsonObject.meta);
    }
}