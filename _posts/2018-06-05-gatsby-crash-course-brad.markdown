---
title: gatsby crash course by brad traversy
layout: post
---
## To install gatsby globally 

~~~bash
npm i -g gatsby-cli
~~~

## to make a gatsby project 

~~~bash
gatsby new <projectname:crashcourse>
~~~

## to run server 

~~~bash
gatsby develop
~~~

If I change the gatsby-config.js file I need to restart server

## plugin for vscode
~~~bash
es7/react/redux/graphql
~~~
page will make inside page folder. 

## Link in gatsby
~~~jsx
import Link from 'gatsby-link'
<li> <Link to='/'>Home</Link> </li>
~~~

## global css 

~~~bash
layouts/index.css
~~~

### posts 
~~~bash
pages/2018-04-09-post-one/index.md
~~~

### post
~~~yml
---
path: "/post-one"
date: "2018-04-09"
title: 'My first Gatsby Post'
author: 'Polo dev'
---
this is my very first blog post in Gatsby
~~~
## Install plugin 
~~~bash
gatsby-source-filesystem
gatsby-transformer-remark
gatbsy-plugin-catch-links

After install those plugin we have to added to gatsby-config.js file 
plugins: [
  'gatsby-plugin-react-helmet',
  'gatsby-plugin-catch-links',
  {
    resolve: 'gatsby-source-filesystem',
    options: {
      path: `${__dirname}/src/pages`,
      name: 'pages'
    }
  },
  'gatsby-transformer-remark'
]
~~~

## graphql server 
~~~
triple underscore
localhost:8000/___graphql
~~~

## edges
edges actually array of nodes. nodes are our file 

## graphql

~~~bash
{
  allMarkdownRemark {
    edges {
      node {
        frontmatter {
          path
          title 
          date 
          author
        }
        excerpt
      }
    }
  }
}
~~~

## blog.js for listing post 

~~~jsx
import React from 'react';
import Link from 'gatsby-link';

const BlogPost = ({data}) => (
    <div>
      <h1>Latest Post</h1>
      {
        data.allMarkdownRemark.edges.map(post => (
          <div key={post.node.id}>
            <h3>{post.node.frontmatter.title}</h3>
            <small>{post.node.frontmatter.author} on {post.node.frontmatter.date}</small>
            <br/>
            <br/>
            <link to={post.node.frontmatter.path}>Readmore</link>
            <br />
            <br />
            <hr />
          </div>
          ))
      }
    </div>
  );

export const pageQuery = graphql`
  query BlogIndexQuery {
    allMarkdownRemark {
      edges {
        node {
          id
          frontmatter {
            path
            title
            date
            author
          }
        }
      }
    }
  }
`
export default BlogPost;
~~~

## single post template 

~~~bash
src/templates/blog-post.js
~~~

code inside blog-post.js 
~~~jsx
{% raw %}

import React from 'react';
import Link from 'gatsby-link';

export default  function Template ({data}) {
  const post = data.markdownRemark;
  return (
      <div>
        <link to='/blog'>Go back</link>
        <hr/>
        <h1>{post.frontmatter.title}</h1>
        <h4>Posted by {post.frontmatter.author} on {post.frontmatter.date}</h4>
        <div dangerouslySetInnerHTML={{__html: post.html }}></div>
      </div>
    );
}
export const postQuery = graphql`
  query BlogPostByPath($path: String!) {
    markdownRemark (frontmatter: {path: {eq: $path}}) {
      html
      frontmatter {
        path
        title 
        author
        date
      }
    }
  }
`
{% endraw %}
~~~

## gatsby-node.js for referencing blog template using bindActionCreators    

~~~jsx
const path = require ('path');

exports.cratePages = ({boundActionCreators, graphql}) => {
  const {createPage} = boundActionCreators;

  const postTemplate = path.resolve('src/template/blog-post.js');
  return graphql (`
    allMarkdownRemark {
      edges {
        node {
          html 
          id 
          frontmatter {
            author 
            date
            title 
            path
          }
        }
      }
    }
    `).then (res => {
      if (res.errors) {
        return Promise.reject (res.errors)
      }
      res.data.allMarkdownRemark.edges.forEach(({node}) => {
        createPage({
          path: node.frontmatter.path,
          component: postTemplate
        })
      })
    })
}
~~~

## hosting on netlify
## all working code of brad
[gatsby crash course](https://github.com/bradtraversy/gatsby_crash_course/tree/master/src)     
[youtube link](https://www.youtube.com/watch?v=6YhqQ2ZW1sc)


















