body {
  background-color: #26272c;
  color: #ffffff;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

h1, h2 {
  color: #ff6f61;
  margin-bottom: 20px;
}

.container {
  max-width: 800px;
  width: 100%;
  padding: 20px;
  background-color: #383b42;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  margin-bottom: 20px;
  text-align: left;
}

h1 {
  font-size: 2.5em;
  margin-bottom: 10px;
}

p {
  font-size: 1.2em;
  line-height: 1.6;
  margin-bottom: 20px;
}

small {
  color: #7c7f85;
}

ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

li {
  background-color: #2f3136;
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  text-align: left;
}

li small {
  display: block;
  margin-top: 10px;
  color: #7c7f85;
}

form {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-top: 20px;
}

textarea {
  width: 100%;
  padding: 15px;
  border-radius: 5px;
  background-color: #2f3136;
  border: none;
  color: #ffffff;
  font-size: 1em;
  height: 100px;
}

button {
  padding: 10px 20px;
  font-size: 1.2em;
  color: #ffffff;
  background-color: #ff6f61;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
  align-self: flex-start;
}

button:hover {
  background-color: #ff5a4a;
}

a {
  color: #ff6f61;
  text-decoration: none;
  margin-top: 20px;
}

a:hover {
  color: #ff5a4a;
}

@media (max-width: 600px) {
  .container {
    padding: 15px;
  }

  h1 {
    font-size: 2em;
  }

  button {
    font-size: 1em;
  }
}
