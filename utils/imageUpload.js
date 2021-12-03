const multer = require("multer");
const path = require("path");

module.exports = (req, res, next) => {
  const storage = multer.memoryStorage();
  const upload = multer({
    storage: storage,
    limits: {
      fields: 1000,
      fieldNameSize: 150, // TODO: Check if this size is enough
      fieldSize: 2000000, //TODO: Check if this size is enough
      // TODO: Change this line after compression
      fileSize: 15000000, // 150 KB for a 1080x1080 JPG 90
    },
    fileFilter: (req, file, cb) => {
      // Allowed ext
      const filetypes = /jpeg|jpg|png/;
      // Check ext
      const extname = filetypes.test(path.extname(file.originalname).toLowerCase());
      // Check mime
      const mimetype = filetypes.test(file.mimetype);

      if (mimetype && extname) {
        return cb(null, true);
      } else {
        return cb(new Error("JPEG, JPG, PNG File Formats are allowed."));
      }
    },
  });

  return upload;
};

// const checkFileType = (file, cb) => {};
