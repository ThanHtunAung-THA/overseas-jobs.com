<?php session_start(); ?>
<?php include '../includes/head.php'; ?>
<body style="  background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/header.php'; ?>

  <section class="info_section layout_margin">
    <div class="container">
      <div class="row">
        <div class="col-md-2 info_links">
          <h4>
            Contact Us
          </h4>
          <ul>
            <li class="active">
              <a href="index.html">
                Home
              </a>
            </li>
            <li>
              <a href="about.html">
                About
              </a>
            </li>
            <li>
              <a class="" href="contact.html">
                Contact
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h4>
            Get in Touch
          </h4>
          <p>
            We'd love to hear from you. Send us a message and we'll get back to you as soon as possible.
          </p>
        </div>
        <div class="col-md-3">
          <div class="info_social">
            <h4>
              Contact Information
            </h4>
            <p>
              Address: 123 Main St, Anytown, USA 12345<br>
              Phone: (555) 555-5555<br>
              Email: <a href="mailto:info@example.com">info@example.com</a>
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info_form">
            <h4>
              Send a Message
            </h4>
            <form action="">
              <input type="text" placeholder="Your Name" />
              <input type="email" placeholder="Your Email" />
              <input type="text" placeholder="Subject" />
              <textarea placeholder="Message"></textarea>
              <button type="submit">
                Send Message
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include '../includes/foot.php'; ?>
</body>
</html>