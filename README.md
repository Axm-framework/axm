<!-- markdownlint-disable no-inline-html -->
<p align="center">
  <br><br>
  <img src="" height="100"/>
  <br>
</p>

<h1 align="center">Axm 1.0</h1>

<p align="center">
	<a href="https://packagist.org/packages/axm/framework"
		><img
			src="https://poser.pugx.org/axm/framework/v/stable"
			alt="Latest Stable Version"
	/></a>
	<a href="https://packagist.org/packages/axm/framework"
		><img
			src="https://poser.pugx.org/axm/framework/downloads"
			alt="Total Downloads"
	/></a>
	<a href="https://packagist.org/packages/axm/framework"
		><img
			src="https://poser.pugx.org/axm/framework/license"
			alt="License"
	/></a>
</p>
<br />
<br />

Leaf is a PHP framework that helps you create clean, simple but powerful web apps and APIs quickly and easily. Leaf introduces a cleaner and much simpler structure to the PHP language while maintaining it's flexibility. With a simple structure and a shallow learning curve, it's an excellent way to rapidly build powerful and high performant web apps and APIs.

## 😎 Basic Usage

This is a "hello world" application created using Axm. After [installing](#-installation) Axm.

```php
<?php

use Axm\Http\Router as Route;

Route::get('/', function () {
  echo '<h1>Hola Mundo</h1>';
});

```

You may quickly test this using the Leaf CLI:

```bash
php axm serve
```

Or with the built-in PHP server:

```bash
php -S localhost:8000
```

## ❤️ Why Axm?

Axm is a highly efficient and feature-rich framework that excels in providing a solid foundation for building powerful web applications and APIs. It offers a comprehensive set of tools and features that streamline the development process and enable developers to create high-performance, scalable, and maintainable solutions.

One of the key advantages of Axm is its simplicity and ease of use. The framework follows a minimalistic approach, focusing on clean and intuitive code syntax. This simplicity not only enhances developer productivity but also promotes code readability and maintainability.

Furthermore, Axm boasts a modular architecture that promotes code reusability and separation of concerns. With its modular structure, developers can easily organize and manage different components of their applications, leading to improved code organization and flexibility.

Another noteworthy aspect of Axm is its extensive documentation and community support. The framework offers comprehensive documentation that provides detailed guidance on its features, usage, and best practices. Additionally, Axm has an active and vibrant community of developers who contribute to its growth, offer support, and share valuable insights.

In summary, when it comes to choosing a framework for developing powerful web applications and APIs, Axm stands out as an optimal selection. Its efficiency, simplicity, modularity, and strong community support make it a compelling choice for developers looking to build robust and scalable solutions.

### The problems
While PHP frameworks can enhance web development efficiency, it is crucial to acknowledge the challenges and limitations they present. Here are some additional issues commonly associated with contemporary PHP frameworks:

1. Steep learning curve: PHP frameworks often entail a demanding learning curve, particularly for developers who are unfamiliar with the framework's conventions or the language itself. Acquiring proficiency in a framework's intricate concepts and functionalities requires time and effort.

2. Performance overhead: Certain PHP frameworks introduce unnecessary performance overhead due to the additional abstraction layers and feature sets they provide. This can impact the overall execution speed of the application, especially in scenarios where high performance is crucial.

3. Code maintenance complexity: Frameworks generally enforce specific coding standards and conventions, necessitating adherence to established practices. For developers unaccustomed to these standards, maintaining and updating the codebase becomes more intricate and time-consuming.

4. Limited flexibility: PHP frameworks often impose a certain level of rigidity, constraining developers in terms of code structure and handling specific use cases. The predefined architecture and conventions may not always align with unique project requirements, resulting in reduced flexibility and potentially cumbersome workarounds.

5. Compatibility challenges: PHP frameworks tend to be tightly integrated into specific ecosystems, making it challenging to seamlessly integrate packages or components that do not align with the framework's architecture or lack direct support. This restricts developers from leveraging a broader range of tools and libraries.

6. Excess code and package overhead: Many PHP frameworks come bundled with extensive codebases, classes, and packages, leading to the inclusion of unnecessary complexity in applications. This additional baggage can result in bloated codebases and adversely impact performance.

Understanding these potential challenges associated with PHP frameworks is essential when considering their adoption. Developers must carefully evaluate their project's requirements and weigh the benefits against the drawbacks to make an informed decision.

### How Axm tackles these

Axm excels at addressing common problems encountered in PHP frameworks through a number of specific technical features and approaches:

Ease of learning: Axm is designed to be the most accessible and easy to learn framework. Even developers new to PHP can start building powerful applications in a matter of minutes by reading the documentation or following tutorials. Axm requires only a basic knowledge of PHP.

2. Lightweight: Axm stands out for being one of the lightest frameworks available. Its optimized and efficient architecture makes it fast and agile compared to other frameworks. Axm minimizes resource usage and offers exceptional performance, resulting in very fast web applications.

3. High speed: The combination of its lightness and optimization make Axm extremely fast. Its optimized code and efficient structure enable fast execution of applications, which improves user experience and optimizes response times.

4. High productivity: Axm is designed to maximize developer productivity. It offers a wide range of features and tools that simplify and streamline the development process. From global functions that allow access to classes from anywhere in the application to intuitive modules and features, Axm allows developers to focus on building their applications without having to deal with repetitive or complex tasks.

5. Modularity: Axm follows a modular approach in its architecture. It is based on independent and easily installable modules, which allows developers to use only the features and functionalities they need in their applications. This modularity not only makes Axm lighter, but also improves code organization and component reuse.

6. Library compatibility: Axm has been designed to be compatible with several existing libraries and frameworks in the PHP ecosystem. This allows developers to take advantage of different libraries and use them together with Axm to build more complete and powerful applications. Axm integrates seamlessly with these libraries, making it easy to collaborate and extend functionality.

7. Scalability: Axm is highly scalable and can adapt to projects of any size. Its flexible and modular architecture allows applications to scale efficiently, either to handle a sudden increase in workload or to add new functionality as the project grows. Axm ensures optimal performance and seamless scalability to adapt to the changing needs of web applications.


## 📦 Installation

You can create a Axm app with the [Axm CLI](https://cli.leafphp.dev)

```bash
php axm create <project-name> --v1 --basic
```

`<project-name>` is the name of your project

You can also use [Composer](https://getcomposer.org/) to install Axm in your project quickly.

```bash
composer require axmphp/axm
```

## 💬 Stay In Touch

-   [Twitter](https://twitter.com/axmphp)
-   [Join the forum](https://github.com/axmphp/axm/discussions/)
-   [Chat on discord](https://discord.com/invite/145555)

## 📓 Learning Leaf 3

-   Leaf has a very easy to understand [documentation](https://axmphp.com) which contains information on all operations in Leaf.
-   You can also check out our [youtube channel](https://www.youtube.com/channel/123w) which has video tutorials on different topics
-   You can also learn from [codelabs](https://codelabs.axmphp.dev) and contribute as well.

## 😇 Contributing

We are glad to have you. All contributions are welcome! To get started, familiarize yourself with our [contribution guide](https://leafphp.dev/community/contributing.html) and you'll be ready to make your first pull request 🚀.

To report a security vulnerability, you can reach out to [@juancristobal_g](https://twitter.com/juancristobal_g) or [@axmphp](https://twitter.com/axmphp) on twitter. We will coordinate the fix and eventually commit the solution in this project.

## 🤩 Sponsoring Axm

Your cash contributions go a long way to help us make Leaf even better for you. You can sponsor Leaf and any of our packages on [open collective](https://opencollective.com/leaf) or check the [contribution page](https://axmphp.com/support/) for a list of ways to contribute.

 
