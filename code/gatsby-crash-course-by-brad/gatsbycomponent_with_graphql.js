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