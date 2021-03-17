import web

urls = (
    '/', 'index'
)
app = web.application(urls, globals())

class index:
    def GET(self):
        name = web.input().get('name')
        if not name:
            return web.template.frender('templates/index.html')("boik")
        return web.template.frender('templates/index.html')(name)

if __name__ == "__main__":
    app.run()
