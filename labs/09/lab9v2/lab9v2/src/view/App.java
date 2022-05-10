package view;

import javax.swing.*;

public class App extends JFrame {
    JPanel mainPanel;
    private JPanel canvasPanel;
    private JPanel instrumentPanel;
    private JButton rectangleButton;
    private JButton triangleButton;
    private JButton ellipseButton;

    public App() {
        super();

        this.initComponents();
        this.initMenu();

        this.setTitle("Editor Application");
        this.setContentPane(this.mainPanel);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.pack();
        this.setSize(800, 600);
        this.setVisible(true);
    }

    private void initComponents() {

    }

    private void initMenu() {
        JMenuBar menuBar = new MenuBar();
        this.setJMenuBar(menuBar);
    }
}
