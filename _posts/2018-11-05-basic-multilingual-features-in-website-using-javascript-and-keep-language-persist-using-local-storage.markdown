---
title: basic multilingual features in website using javascript and keep language persist using local storage
layout: post
---
following snippet helps me to convert a basic site to 2 language site 

## Html code for menu
~~~html
<h3
data-langen="Sorry this resturent does not have any menu yet . please try again later"
data-langhe="מצטערים, אין תפריט זה עדיין. בבקשה נסה שוב מאוחר יותר"
class="blanker">Sorry this resturent does not have any menu yet . please try again later </h3>

~~~

## initial code for checking country (in my case Israel) and changed language to Hebrew
~~~js
function changeLanguage (lang) {
    if (lang == 'en') {
        $("[data-langen]").each(function (index , val) {
            $(this).html($(this).attr('data-langen'));
        });
    } else {
        $("[data-langhe]").each(function (index , val) {
            $(this).html($(this).attr('data-langhe'));
        });
    }
}
if (localStorage.getItem('user_lang')) {
  let lang = localStorage.getItem('user_lang');
  changeLanguage(lang);
} else {
  $.get('http://ip-api.com/json', (response) => {
  	if (response.countryCode == "IL") {
      localStorage.setItem("user_lang", 'il')
      changeLanguage('he');
  	}
  })
}
~~~

## language icon for changing language manually 

~~~html
<div class="language-changer">
  <p><a href="<?= (@end(explode('@', request()->route()->getAction('controller'))) == 'catmenu') ? action('frontEndController@language', ['lan' => 'en']) : '#'; ?>" class="en"><img src="{{ asset('img/en.png') }}" alt="Language icon is not available"></a></p>
  <p>
    <a href="<?= (@end(explode('@', request()->route()->getAction('controller'))) == 'catmenu') ? action('frontEndController@language', ['lan' => 'he']) : '#'; ?>" class="il"><img src="{{ asset('img/il.png') }}" alt="Language icon is not available"></a>
  </p>
</div>
~~~

## click event when user click on language changing button

~~~js
$(".language-changer  a").on('click' , function (event) {
    if ($(this).attr('href') == '#') {
        event.preventDefault();
        var lang = $(this).attr('class');
        localStorage.setItem("user_lang", lang)
        changeLanguage(lang)
    }
});
~~~


