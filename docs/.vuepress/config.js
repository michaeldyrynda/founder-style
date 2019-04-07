module.exports = {
    title: "Founder Style Guide",
    description: "A set of styles and conventions to follow when building Laravel projects.",
    serviceWorker: true,
    themeConfig: {
        repo: 'michaeldyrynda/founder-style',
        editLinks: true,
        docsDir: 'docs',
        docsBranch: 'master',
        lastUpdated: 'Last Updated',
        nav: [
            { text: 'Founder', link: 'https://github.com/michaeldyrynda/founder.git' }
        ],
        sidebar: [
            ['/', 'Founder'],
            '/production/',
            '/packages/',
            '/docblocks-comments/',
            '/conditionals/',
            '/configuration/',
            '/routing/',
            '/controllers/',
            '/views/',
            '/validation/',
            '/eloquent/',
            '/migrations-schema/'
        ]
    }
}
