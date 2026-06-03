module.exports = {
  apps: [
    {
      name: "microlearning",
      script: "npm",
      args: "run dev",
      watch: false,
      env: {
        NODE_ENV: "development",
      }
    }
  ]
};
