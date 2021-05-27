# Oye Socio
## An email-based social media network for Cuba

Developed by Yamileth Medina, Miguel Hernandez, and Charles Villard during competition the HeyCuba Hackathon, Oye Socio provides a Facebook-like service to those in Cuba with access to email.

### The Problem with Facebook and Social Media in Cuba

While it's common to assume that the Castro regime in Cuba censors everything, it couldn't be further from the truth. Very little is censored in Cuba. And why would they need to, when the low bandwidth the island receives as a whole makes it difficult and costly to access almost any site. Throw in the fact that the average cost of Internet access at local internet cafes at $2.00/hour in an island nation with an average monthly salary of $20.00/hour, and you can see why they can leave it accessible.

For folks stateside, we enjoy some of the highest bandwidth availability in the world, and jest about wasting time on social media, but Cubans are starved for connection with family abroad and the rest of the outside world. It's to solve problems like this that Apretaste, an email server app that connects Cubans with to the Internet by a low-bandwidth, cost effective medium: email. It's during a competition hosted by Apretaste that we decided to build them a social media network that they could use and that could scale if and when Internet access improves. We call this service <b>Oye Socio</b>.

### Features of Oye Socio

Oye Socio brings many of the key features of social media network to email users by using a Java-based API and SQL database in tandem with PHP and the Smarty templating engine. Users email the service with the keyword *oyesocio* in the subject line, and it will check the sender's email address against its database and reply with a signup form if they haven't created a previous account. Should they already have an account, they'll be sent an up-to-date digest of posts from their friends and favorite organizations in Cuba and abroad. The platform also supports friend searches and requests, posting comments, and more.

### Check back often

We've only just started building this service, and we intend on continuing to grow it into a viable, long-term solution to Cuba's disconnect with the world. More documentation will be hosted here in the future, so check back soon.

### Apretaste and the HeyCuba Hackathon

Oye Socio was the brainchild of Miguel Hernandez, Yamileth Medina, and Charles Villard, built during the HeyCuba hackathon. It was a thoroughly challenging and satisfying project, and would have been impossible without the help and mentorship of Apretaste's creator, Salvi Pascual, and Nizar Khalife.

