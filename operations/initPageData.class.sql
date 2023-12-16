insert into pageInfo (
    logo,
    name
)
VALUES("/frontend/images/logo-black.svg","BLUEKET");



INSERT INTO navigations (
    name,
    hashTag
)
VALUES("Developer","Developer")
VALUES("About Us","AboutUs")
VALUES("Services","Services")
VALUES("Portfolio","Portfolio")
VALUES("Blogs","Blogs")
VALUES("Contact Us","ContactUs");


INSERT INTO subNavigations (
    name,
    url,
    hashTag
)
VALUES("Contact Austine Samuel","https://wa.me/08072999853","Developer"),
VALUES("About Page 1","#","AboutUs"),
VALUES("About Page 2","#","AboutUs"),
VALUES("Service 1","#","Services"),
VALUES("Service 2","#","Services"),
VALUES("Service 3","#","Services"),
VALUES("Portfolio 1","#","Portfolio"),
VALUES("Portfolio 2","#","Portfolio"),
VALUES("Portfolio 3","#","Portfolio"),
VALUES("Blogs 1","#","Blogs"),
VALUES("Blogs 2","#","Blogs"),
VALUES("Contact Us 1","#","ContactUs")
VALUES("Contact Us 2","#","ContactUs")
VALUES("Contact Us 3","#","ContactUs");


insert into editHeadingTexts (
    h1,
    playButtonLink,
    subH1,
    getStartedLink,
    headingMessageText
)
VALUES("Design Products
Deliver Experience",
"#",
"A full-service digital marketing firm that specialises in human-centered experiences. We bring companies and people together.",
"https://wa.me/08072999853",
"We Design Digital Solutions
For Brands, Companies & Startups."
)