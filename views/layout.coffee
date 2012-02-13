doctype 5
html ->
  head ->
    title "#{@title or 'index'}"
    link rel: "stylesheet", href: "/stylesheets/style.css"
  body ->
    @body