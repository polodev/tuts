---
title: gatsby-leveluptuts
layout: post
---
## getting started with gatsby 
~~~bash
npm install --global gatsby-cli
~~~

~~~bash
gatsby new <projectName>
~~~

~~~bash
gatsby develop
~~~

## gatesby files overview
for site configuration 
gatsby-config.js

## adding plugin and using sass             
[plugin authoring system - important for naming convetion](https://www.gatsbyjs.org/docs/plugin-authoring/)          
[plugin library](https://www.gatsbyjs.org/plugins/)                       
import scss file instead of .css file       
~~~bash
npm install --save gatsby-plugin-sass
~~~

~~~jsx
// in gatsby-config.js
plugins: [`gatsby-plugin-sass`]

// or 

plugins: [
  {
    resolve: 'gatsby-plugin-sass',
    options: {
      precision: 8
    }
  }
]
~~~

## blog with markdown
~~~bash
gatsby-source-filesystem
~~~

~~~jsx
plugins: [
  {
    resolve: 'gatsby-source-filesystem',
    options: {
      path: `${__dirname}/src/pages`,
      name:'pages'
    }
  },
  'gatsby-transformer-remark'
]
~~~

~~~bash
gatsby-transformer-remark
~~~

~~~jsx
// pages/08-10-2018/index.js
---
path: '/first-post',
title: 'First Blog post'
---
# Hello
~~~

~~~jsx
// src/templates/post.js
import React from 'react';
import Helmet from 'react-helmet';
export default function Template({data}) {
  const {markdownRemark: post} = data // const post = data.markdownRemark
  return (
    <div>
      <h1>{post.frontmatter.title}</h1>
    </div>
    )
}

export const postQuery = graphql`
  query BlogPostByPath($path: String!) {
    markdownRemark(frontmatter: { path: { eq: $path } }) {
      html 
      frontmatter {
        path
        title
      }
    }
  }
`
~~~

## blog with markdown 2

~~~jsx
// gatsby-node.js
const path = require('path');

export.createPages = ({boundActionCreators, graphql}) => {
  const {createPage} = boundActionCreators;
  const postTemplate = path.resolve('src/template/post.js');
  return graphql(`{
    allMarkdownRemark{
      edges {
        node {
          html
          id 
          frontmatter {
            path
            title
          }
        }
      }
    }
    }`).then(res => {
      if (res.errors) {
        return Promise.reject(res.errors);
      }
      return res.data.allMarkdownRemark.edges.forEach(({node}) =>{
        createPage({
          path: node.frontmatter.path,
          component:  postTemplate
          })
        }) 
      })
}




~~~














