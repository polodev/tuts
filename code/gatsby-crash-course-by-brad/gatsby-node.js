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