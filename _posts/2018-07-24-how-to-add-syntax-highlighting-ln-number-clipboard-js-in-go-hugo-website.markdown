---
title: how to add syntax highlighting, ln number, clipboard js in go hugo website
layout: post
---

# Installing Pygmentation
first you have to download python Pygments in your machine. In mac you can easily download by `pip install Pygments` . If you use ubuntu `sudo apt-get install python3-pygments`  

# adding pygmentsUseClasses in `config.toml` file 

~~~toml
pygmentsUseClasses=true
~~~

# generate chroma style using `hugo gen` command 

~~~bash
hugo gen chromastyles --style=monokai > static/css/syntax.css
// for more info run following command
hugo gen chromastyles -h
~~~
I have used monokai theme. There are a lot of themes available. all themes are available [here](https://xyproto.github.io/splash/docs/longer/all.html) to check. Add generated css in your html file 

~~~html
{% raw %}
  <link rel='stylesheet' href='{{.Site.BaseURL}}css/syntax.css'/>
{% endraw %}
~~~

# writing your code in between highlight shortcode in your markdown file

~~~gohtml
{% raw %}
{{< highlight go "linenos=table,hl_lines=8 15-17,linenostart=199" >}}
// ... code
{{< / highlight >}}
{% endraw %}
~~~

# for the php highlight 
In case of of `php` highlight, your code block should be start with `<?php`. otherwise Pygments didn't guess your language for syntax highlighting. I feel like its a bug. I am a php developer. So my most of the code snippet will be in php.  

# adding clipboard js in your html 
I have added cdn you can download and added to your path
~~~html
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
~~~

# add copy to clipboard button in js programmatically
following code will only work if you pass `linenos=table` param in `highlight` shortcode 
~~~js
var tables = document.querySelectorAll('table.lntable');
tables.forEach(function (table) {
  var tds = table.querySelectorAll('td');
  if (tds.length > 1) {
    var codeTd = tds[1];
    var pre = codeTd.querySelector('pre');
    var button = document.createElement('button');
    button.className = 'copy-button';
    button.textContent = 'Copy';
    pre.appendChild(button);
  }
})
~~~
When we set `linenos=table` params it will generate table with 2 `td`. first `td` hold line number 2nd `td` hold actual code. So we targeted 2nd `td` and append `button.copy-button`. 

# add style for clipboard button 
following style make `button.copy-button` top right corner of code block. 
~~~css
table.lntable {
	position: relative;
}
.copy-button {
	position: absolute;
	top: 0px;
	right: 0px;
	display: inline-block;
	color: maroon;
	border: 1px solid maroon;
	cursor: pointer;
}
.copy-button:hover {
	background-color: maroon;
	color: white;
}
~~~

# adding click handler to copy from clipboard 

~~~js
// setting up target for copy
var copyCode = new ClipboardJS('.copy-button', {
    target: function(trigger) {
        return trigger.previousElementSibling;
    }
});

// success message
copyCode.on('success', function(event) {
    event.clearSelection();
    event.trigger.textContent = 'Copied';
    window.setTimeout(function() {
        event.trigger.textContent = 'Copy';
    }, 2000);
});
// error message
copyCode.on('error', function(event) { 
    event.trigger.textContent = 'Press "Ctrl + C" to copy';
    window.setTimeout(function() {
        event.trigger.textContent = 'Copy';
    }, 2000);
});

~~~

# Using `highlightjs` alongside `Pygments`.  - not necessary at all

If you want to add `highlightjs` alongside this `Pygments` first add css and js of highlights js

~~~html
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css'/>
<script src='https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js'></script>
~~~
# instantiate `highlightjs`
~~~js
hljs.initHighlightingOnLoad();
~~~

# adding copy button by filtering already added `copy-button` in `pygments` block

~~~js
var pres = document.querySelectorAll('pre');
pres.forEach(function (pre, i) {
  if (pre.parentNode.nodeName !== 'TD') {
    var isLanguage = pre.children[0].className.indexOf('language-');
    if ( isLanguage === 0 ) {
      var button = document.createElement('button');
      button.className = 'copy-button';
      button.textContent = 'Copy';
      pre.appendChild(button);
    }
  }
})
~~~



Thats all. Thank you






