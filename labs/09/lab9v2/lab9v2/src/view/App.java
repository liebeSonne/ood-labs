package view;

import controller.MainController;
import controller.MainControllerInterface;
import document.DocumentInterface;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class App extends JFrame {
    JPanel mainPanel;
    private JPanel canvasPanel;
    private JPanel instrumentPanel;
    private JButton rectangleButton;
    private JButton triangleButton;
    private JButton ellipseButton;
    private JButton UPDButton;

    MainControllerInterface controller;

    public App(DocumentInterface document) {
        super();

        this.initFrame();
        this.initShapesController(document);
        this.initComponents();
        this.initMenu();
    }

    private void initFrame() {
        this.setTitle("Editor Application");
        this.setContentPane(this.mainPanel);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.pack();
        this.setSize(800, 700);
    }

    private void initShapesController(DocumentInterface document) {
        Point center = new Point(this.canvasPanel.getWidth() /2, this.canvasPanel.getHeight() / 2);
        this.controller = new MainController(center, document);
        ((CanvasPanel)this.canvasPanel).setController(this.controller);
    }

    private void initComponents() {
        this.bindBtnEvents();
    }

    private void initMenu() {
        JMenuBar menuBar = new MenuBar(this.controller, (CanvasPanel) this.canvasPanel);
        this.setJMenuBar(menuBar);
    }

    private void bindBtnEvents() {
        this.rectangleButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addRectangle();
                drawCanvas();
            }
        });
        this.triangleButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addTriangle();
                drawCanvas();
            }
        });
        this.ellipseButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addEllipse();
                drawCanvas();
            }
        });

        UPDButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                drawCanvas();
            }
        });
    }

    // @TODO - remove this method
    private void drawCanvas() {
        ((CanvasPanel)this.canvasPanel).redraw();
    }

    private void createUIComponents() {
        this.canvasPanel = new CanvasPanel();
    }
}
