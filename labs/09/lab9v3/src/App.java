import model.Document;
import view.form.MainView;

import javax.swing.*;

public class App {
    public static void main(String[] args) {

        Document document = new Document();

        MainView jFrame = new MainView(document);
        jFrame.setTitle("Editor App");
        jFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        jFrame.pack();
        jFrame.setSize(800, 700);
        jFrame.setVisible(true);
    }
}
